<?php

namespace App\Http\Controllers;
use App\Convention;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;

class ReportController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function filterProgram(){
    	$conventions = Convention::whereNull('estado');//->orderBy('nombre')->pluck('nombre', 'id');
    	if(auth()->user()->role->isAdmin != 1)
            $conventions = $conventions->where('id', auth()->user()->getConvention());
       	$conventions = $conventions->orderBy('nombre')->pluck('nombre', 'id');
    	return view('reports.fltProgram', [
            'conventions' => $conventions
        ]);
    }

    public function showProgram(Request $request){
    	$reservas = DB::table('vRESERVA')->where('ESTADO', '4');
    	$conventionDESC = '';
    	if (!is_null($request->convention_id)) {
    		$reservas = $reservas->where('CONVENTION_ID', $request->convention_id);
    		$conventionDESC = Convention::find($request->convention_id)->select('nombre')->first();
    	}
    	elseif (auth()->user()->role->isAdmin != 1)
    		$reservas = $reservas->where('CONVENTION_ID', auth()->user()->getConvention());

    	if(!is_null($request->fecha_inicio)){
    		$fecha_reunion = $request->fecha_inicio;
        	$fecha_reunion = substr($fecha_reunion,6,4) . substr($fecha_reunion,3,2) . substr($fecha_reunion,0,2);
			$reservas = $reservas->where('FECHA_REUNION_INT', '>=', $fecha_reunion);
    	}
    	if(!is_null($request->fecha_final)){
    		$fecha_reunion = $request->fecha_final;
        	$fecha_reunion = substr($fecha_reunion,6,4) . substr($fecha_reunion,3,2) . substr($fecha_reunion,0,2);
			$reservas = $reservas->where('FECHA_REUNION_INT', '<=', $fecha_reunion);
    	}
    	$reservas = $reservas->orderBy('FECHA_REUNION_INT')->orderBy('HORA_INICIO')->get();
    	for ($i = 0; $i < count($reservas); $i++){
    		$reservaSalon = DB::table('vRESERVASALON')->select('SALON')->where('RESERVE_ID', $reservas[$i]->ID_RESERVA)->orderBy('SALON')->get();
    		$reservaResource = DB::table('vRESERVARESOURCE')->select('CANTIDAD', 'RECURSO', 'RECURSO_DESC', 'TIPO')->where('RESERVE_ID', $reservas[$i]->ID_RESERVA)->orderBy('TIPO')->orderBy('RECURSO')->get();

    		$reservas[$i]->SALONES = $reservaSalon;
    		$reservas[$i]->RECURSOS = $reservaResource;
    	}

    	$dataSend = ['reserves' => $reservas, 'fecha_inicio' => $request->fecha_inicio, 'fecha_final' => $request->fecha_final, 'convention' => $request->convention_id, 'conventionDESC' => $conventionDESC];

    	//return view('reports.idxProgram', $dataSend);

        return PDF::loadView('reports.idxProgram', $dataSend)->download('Programacion.pdf');
    }
}
