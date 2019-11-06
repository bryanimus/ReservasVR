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
use Webpatser\Uuid\Uuid;
use Illuminate\Http\Request;
use Carbon;
use App\Http\Requests\SaveReserveRequest;

class ReservaController extends Controller
{
    public function __construct(){
        $this->middleware('auth')->except('getMinistry');
    }

    public function Init(){
        $conventions = Convention::whereNull('estado')->pluck('nombre', 'id');
        $users = User::whereNull('estado')->pluck('name', 'id');
        $reuniontypes = ReunionType::whereNull('estado')->pluck('nombre', 'id');
        $montajes = Resource::whereNull('estado')->where('tipo','1')->pluck('nombre', 'id');
        $mantelerias = Resource::whereNull('estado')->where('tipo','2')->pluck('nombre', 'id');
        $tecnicos = Resource::whereNull('estado')->where('tipo','3')->pluck('nombre', 'id');
        $musicas = Resource::whereNull('estado')->where('tipo','4')->pluck('nombre', 'id');
        $cristalerias = Resource::whereNull('estado')->where('tipo','5')->pluck('nombre', 'id');
        $alimentos = Resource::whereNull('estado')->where('tipo','6')->pluck('nombre', 'id');
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

        $dataInsert = [
            'convention_id' => $request->convention_id,
            'tamano_reunion' => $request->tamano_reunion,
            'user_id' => auth()->user()->id,
            'user_encargado_id' => $request->user_encargado_id,
            'ministry_id' => $request->ministry_id,
            'costo_evento' => $request->costo_evento,
            'reuniontype_id' => $request->reuniontype_id,
            'proposito' => $request->proposito,
            'fecha_reunion' => $fecha_reunion,
            'hora_inicio' => $hora_inicio,
            'hora_fin' => $hora_fin,
            'fecha_solicitud' => now()->format('Ymd'),
            'hora_solicitud' => now()->format('Hi'),
            'estado' => 1,
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
            foreach ($request->idReq as $valor)
                ReserveResource::create([ 'reserve_id' => $rowReserve->id, 'resource_id' => $valor ]);

        // Ingreso Cristalería y Loza
        if (isset($request->idCristaleria))
            foreach ($request->idCristaleria as $valor)
                ReserveResource::create([ 'reserve_id' => $rowReserve->id, 'resource_id' => $valor ]);

         // Ingreso Alimentos y Bebidas
        if (isset($request->idalimento))
            foreach ($request->idalimento as $valor)
                ReserveResource::create([ 'reserve_id' => $rowReserve->id, 'resource_id' => $valor ]);

        return redirect()->route('home')->with('status','Su Reserva Ha Sido Creada con Éxito');
    }

    public function getMinistry($id){
        $ministries = Ministry::select('id','nombre')->whereNull('estado')->where('convention_id',$id)->get();
        return $ministries;
    }

    public function IndexGestReserva() {
        return view('reservas.index', [
            'reserves' => Reserve::where('estado' , '1')->oldest('id')->paginate(10)
        ]);
    }

    public function showReserva(Reserve $id){
        $convention = Convention::find($id->convention_id)->nombre;
        $ministry = Ministry::find($id->ministry_id)->nombre;
        $userEncargado = User::find($id->user_encargado_id)->name;
        $userAsignado = User::find($id->user_id)->name;
        if ($id->costo_evento == 1) $costoEvento = 'Presupuesto'; else $costoEvento = 'Pago Directo';
        $fechaSolicitud = $id->fecha_solicitud;
        $fechaSolicitud = substr($fechaSolicitud, 6, 2) . '/' . substr($fechaSolicitud, 4, 2) . '/' . substr($fechaSolicitud, 0, 4);
        $fechaReunion = $id->fecha_reunion;
        $fechaReunion = substr($fechaReunion, 6, 2) . '/' . substr($fechaReunion, 4, 2) . '/' . substr($fechaReunion, 0, 4);
        $horaInicio = substr('0000' . $id->hora_inicio, -4);
        $horaInicio = substr($horaInicio, 0, 2) . ':' . substr($horaInicio, 2, 2);
        $horaFin = substr('0000' . $id->hora_fin, -4);
        $horaFin = substr($horaFin, 0, 2) . ':' . substr($horaFin, 2, 2);
        $tipoReunion = ReunionType::find($id->reuniontype_id)->nombre;
        $montaje = Resource::find($id->montaje_id)->nombre;
        $manteleria = Resource::find($id->manteleria_id);
        if (!is_null($manteleria)) $manteleria = $manteleria->nombre;
        $musical = Resource::find($id->musical_id);
        if (!is_null($musical)) $musical = $musical->nombre;
        $ReqTecnico = Resource::select('resources.nombre')->join('reserveresource', 'resources.id', '=', 'reserveresource.resource_id')->where('resources.tipo', '3')->get();
        $Cristaleria = Resource::select('resources.nombre')->join('reserveresource', 'resources.id', '=', 'reserveresource.resource_id')->where('resources.tipo', '5')->get();
        $Alimento = Resource::select('resources.nombre')->join('reserveresource', 'resources.id', '=', 'reserveresource.resource_id')->where('resources.tipo', '6')->get();

        $dataSend = [
            'convention' => $convention, 'ministry' => $ministry, 'userEncargado' => $userEncargado, 'userAsignado' => $userAsignado, 'costoEvento' => $costoEvento,
            'proposito' => $id->proposito, 'fechaSolicitud' => $fechaSolicitud, 'fechaReunion' => $fechaReunion, 'horaInicio' => $horaInicio, 'horaFin' => $horaFin,
            'tipoReunion' => $tipoReunion, 'cantidadPersona' => $id->cantidad_persona, 'montaje' => $montaje, 'manteleria' => $manteleria, 'musical' => $musical,
            'ReqTecnico' => $ReqTecnico, 'Cristaleria' => $Cristaleria, 'Alimento' => $Alimento
        ];
        return view('reservas.frmGestReserva', $dataSend);
    }

    public function StoreGestReserva(){

    }
}
