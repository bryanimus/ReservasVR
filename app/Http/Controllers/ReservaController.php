<?php

namespace App\Http\Controllers;
use App\Reserve;
use App\User;
use App\Convention;
use App\Salon;
use App\ReunionType;
use App\Ministry;
use App\Resource;
use App\ReserveResource;
use App\ReserveSalon;
use Webpatser\Uuid\Uuid;
use Illuminate\Http\Request;
use Carbon;
use App\Http\Requests\SaveReserveRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\MsgSolicitudReceived;

class ReservaController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('checkRole:opcSolicitar')->only('Init', 'Store', 'getMinistry', 'getResourceDesc');
        $this->middleware('checkRole:opcAprobar')->only('IndexGestReserva', 'showReserva', 'StoreGestReserva');
        $this->middleware('checkRole:opcReserva')->only('IndexResReserva', 'showResReserva', 'StoreResReserva');
    }

    public function Init(){
        $conventions = Convention::whereNull('estado')->orderBy('nombre')->pluck('nombre', 'id');
        $users = User::whereNull('estado')->orderBy('name')->pluck('name', 'id');
        $reuniontypes = ReunionType::whereNull('estado')->orderBy('nombre')->pluck('nombre', 'id');
        $montajes = Resource::whereNull('estado')->where('tipo','1')->orderBy('nombre')->pluck('nombre', 'id');
        $mantelerias = Resource::whereNull('estado')->where('tipo','2')->orderBy('nombre')->pluck('nombre', 'id');
        $tecnicos = Resource::whereNull('estado')->where('tipo','3')->orderBy('nombre')->pluck('nombre', 'id');
        $musicas = Resource::whereNull('estado')->where('tipo','4')->orderBy('nombre')->pluck('nombre', 'id');
        $cristalerias = Resource::whereNull('estado')->where('tipo','5')->orderBy('nombre')->pluck('nombre', 'id');
        $alimentos = Resource::whereNull('estado')->where('tipo','6')->orderBy('nombre')->pluck('nombre', 'id');
    	return view('reservas.frmReserva', [
            'conventions' => $conventions, 'users' => $users, 'reuniontypes' => $reuniontypes,
            'montajes' => $montajes, 'mantelerias' => $mantelerias, 'tecnicos' => $tecnicos,
            'cristalerias' => $cristalerias, 'alimentos' => $alimentos, 'musicas' => $musicas
        ]);
    }

    public function Store(SaveReserveRequest $request){
        $fecha_reunion = $request->fecha_reunion;
        $fecha_reunion = substr($fecha_reunion,6,4) . substr($fecha_reunion,3,2) . substr($fecha_reunion,0,2);
        $hora_inicio = str_replace(":", "", $request->hora_inicio);
        $hora_fin = str_replace(":", "", $request->hora_fin);
        $estado = 1;
        if ($request->typeEvent == "2") $estado = 3;

        $dataInsert = [
            'nombre' => $request->nombre,
            'convention_id' => $request->convention_id,
            'tamano_reunion' => $request->tamano_reunion,
            'user_id' => auth()->user()->id,
            'user_encargado_id' => $request->user_encargado_id,
            'ministry_id' => $request->ministry_id,
            'tipo_evento' => $request->typeEvent,
            'costo_evento' => $request->costo_evento,
            'reuniontype_id' => $request->reuniontype_id,
            'proposito' => $request->proposito,
            'fecha_reunion' => $fecha_reunion,
            'hora_inicio' => $hora_inicio,
            'hora_fin' => $hora_fin,
            'fecha_solicitud' => now()->format('Ymd'),
            'hora_solicitud' => now()->format('Hi'),
            'estado' => $estado,
            'cantidad_persona' => $request->cantidad_persona,
            'montaje_id' => $request->montaje_id,
            'manteleria_id' => $request->manteleria_id,
            'musical_id' => $request->musical_id,
            'observaciones' => $request->observaciones
        ];
        // Ingreso Reserva
        $rowReserve = Reserve::create($dataInsert);

        // Ingreso Requerimientos Técnicos
       if (isset($request->idReq))
            for ($i = 0; $i < count($request->idReq); $i++)
                ReserveResource::create([ 'reserve_id' => $rowReserve->id, 'resource_id' => $request->idReq[$i], 'cantidad' => $request->numReq[$i] ]);

        // Ingreso Cristalería y Loza
        if (isset($request->idCristaleria))
            for ($i = 0; $i < count($request->idCristaleria); $i++)
                ReserveResource::create([ 'reserve_id' => $rowReserve->id, 'resource_id' => $request->idCristaleria[$i], 'cantidad' => $request->numcristaleria[$i] ]);

         // Ingreso Alimentos y Bebidas
        if (isset($request->idalimento))
            for ($i = 0; $i < count($request->idalimento); $i++)
                ReserveResource::create([ 'reserve_id' => $rowReserve->id, 'resource_id' => $request->idalimento[$i], 'cantidad' => $request->numalimento[$i] ]);

        $dataMail = [
            'id' => $rowReserve->id, 'nombre' => $request->nombre
        ];
        //Mail::to(auth()->user()->email)->send(new MsgSolicitudReceived($dataMail));

        return redirect()->route('home')->with('status','Su Reserva Ha Sido Creada con Éxito');
    }

    public function getMinistry($id){
        $ministries = Ministry::select('id','nombre')->whereNull('estado')->where('convention_id',$id)->orderBy('nombre')->get();
        return $ministries;
    }

    public function getResourceDesc($id){
        $resource = Resource::select('descripcion')->find($id);
        return $resource->descripcion;
    }

    public function IndexGestReserva() {
        return view('reservas.index', [
            'reserves' => Reserve::where('estado' , '1')->oldest('id')->paginate(10)
        ]);
    }

    public function showReserva(Reserve $id){
        $reserva = DB::table('vRESERVA')->where('ID_RESERVA', $id->id)->first(); // Consultar Información General de la Reserva
        $ReqTecnico = DB::table('vRESERVARESOURCE')->select('RECURSO', 'CANTIDAD', 'RECURSO_DESC')->where('TIPO', '3')->where('RESERVE_ID', $id->id)->get();
        $Cristaleria = DB::table('vRESERVARESOURCE')->select('RECURSO', 'CANTIDAD', 'RECURSO_DESC')->where('TIPO', '5')->where('RESERVE_ID', $id->id)->get();
        $Alimento = DB::table('vRESERVARESOURCE')->select('RECURSO', 'CANTIDAD', 'RECURSO_DESC')->where('TIPO', '6')->where('RESERVE_ID', $id->id)->get();
        $dataSend = [
            'reserva' => $reserva, 'ReqTecnico' => $ReqTecnico, 'Cristaleria' => $Cristaleria, 'Alimento' => $Alimento
        ];
        return view('reservas.frmGestReserva', $dataSend);
    }

    public function StoreGestReserva(SaveReserveRequest $request, Reserve $id){
        $dataUpdate = [
            'estado' => $request->estado,
            'user_aprueba_id' => auth()->user()->id,
            'fecha_aprueba' => now()->format('Ymd'),
            'hora_aprueba' => now()->format('Hi'),
            'observacion_aprueba' => $request->observacion_aprueba
        ];
        $id->update($dataUpdate);
        return redirect()->route('reserva.Index')->with('status','Se ha gestionado la reserva');
    }

    public function IndexResReserva(){
        return view('reservas.indexRes', [
            'reserves' => Reserve::where('estado' , '3')->oldest('id')->paginate(10)
        ]);
    }

    public function showResReserva(Reserve $id){
        $reserva = DB::table('vRESERVA')->where('ID_RESERVA', $id->id)->first(); // Consultar Información General de la Reserva
        $ReqTecnico = DB::table('vRESERVARESOURCE')->select('RECURSO', 'CANTIDAD', 'RECURSO_DESC')->where('TIPO', '3')->where('RESERVE_ID', $id->id)->get();
        $Cristaleria = DB::table('vRESERVARESOURCE')->select('RECURSO', 'CANTIDAD', 'RECURSO_DESC')->where('TIPO', '5')->where('RESERVE_ID', $id->id)->get();
        $Alimento = DB::table('vRESERVARESOURCE')->select('RECURSO', 'CANTIDAD', 'RECURSO_DESC')->where('TIPO', '6')->where('RESERVE_ID', $id->id)->get();
        $salones = Salon::whereNull('estado')->where('convention_id', $id->convention_id)->orderBy('nombre')->pluck('nombre', 'id');
        $dataSend = [
            'reserva' => $reserva, 'ReqTecnico' => $ReqTecnico, 'Cristaleria' => $Cristaleria, 'Alimento' => $Alimento, 'salones' => $salones
        ];
        return view('reservas.frmResReserva', $dataSend);
    }

    public function StoreResReserva(SaveReserveRequest $request, Reserve $id){
        $reserve = Reserve::find($id->id);

        $reserve->estado = 4;
        $reserve->priv_evento = $request->privEvent;
        $reserve->user_reserva_id = auth()->user()->id;
        $reserve->fecha_reserva = now()->format('Ymd');
        $reserve->hora_reserva = now()->format('Hi');
        $reserve->observacion_reserva = $request->observacion_reserva;

        if (isset($request->chgDate)){
            $fecha_reunion = $request->fecha_reunion;
            $fecha_reunion = substr($fecha_reunion,6,4) . substr($fecha_reunion,3,2) . substr($fecha_reunion,0,2);
            $hora_inicio = str_replace(":", "", $request->hora_inicio);
            $hora_fin = str_replace(":", "", $request->hora_fin);

            $reserve->fecha_reunion = $fecha_reunion;
            $reserve->hora_inicio = $hora_inicio;
            $reserve->hora_fin = $hora_fin;
        }

        $isFileUPD = false;
        if (isset($request->fileCot))
            if ($request->hasfile('fileCot')){
                $image = $request->file('fileCot');
                $fileName = $image->getClientOriginalName();
                $new_name =  auth()->user()->id . '_' . now()->format('Ymd') . '.' . now()->format('His') . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('Files'), $new_name);

                $reserve->NOMBRE_ARCHIVO = $fileName;
                $reserve->ARCHIVO = $new_name;
                $isFileUPD = true;
            }

        $reserve->save();
        //if ($isFileUPD)
        //    unlink(public_path('Files') . '\\' . $new_name);

        for ($i = 0; $i < count($request->idSalon); $i++)
            ReserveSalon::create([ 'reserve_id' => $id->id, 'salon_id' => $request->idSalon[$i] ]);

        return redirect()->route('reserva.resIndex')->with('status','Se ha reservado la reserva');
    }

    public function misInit(){
        return view('reservas.miIndex', [
            'reserves' => Reserve::where('user_id', auth()->user()->id)->oldest('id')->paginate(10)
        ]);
    }

    public function delMiReserva(Reserve $reserve){
        $reserve->update(['estado' => 7]);
        return redirect()->route('reserva.miIndex')->with('status','La Reserva fue Eliminada con Éxito');
    }

    public function download(){
        $reserve = Reserve::find(6);
        $download = public_path('Files') . '\\' . $reserve->ARCHIVO;
        return response()->download($download);
    }
}
