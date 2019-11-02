<?php

namespace App\Http\Controllers;
use App\Reserve;
use App\User;
use App\Convention;
use App\Salon;
use App\ReunionType;
use App\Ministry;
use App\Resource;
use Webpatser\Uuid\Uuid;
use Illuminate\Http\Request;
use App\Http\Requests\SaveReserveRequest;

class ReservaController extends Controller
{
    public function Init(){
        $conventions = Convention::pluck('nombre', 'id');
        $users = User::pluck('name', 'id');
        $reuniontypes = ReunionType::pluck('nombre', 'id');
        $montajes = Resource::all()->where('tipo','1')->pluck('nombre', 'id');
        $mantelerias = Resource::all()->where('tipo','2')->pluck('nombre', 'id');
        $tecnicos = Resource::all()->where('tipo','3')->pluck('nombre', 'id');
    	return view('reservas.frmReserva', [
            'conventions' => $conventions,
            'users' => $users,
            'reuniontypes' => $reuniontypes,
            'montajes' => $montajes,
            'mantelerias' => $mantelerias,
            'tecnicos' => $tecnicos
        ]);
    }

    public function Store(SaveReserveRequest $request){
        dd($request);
    }

    public function getMinistry($id){
        $ministries = Ministry::select('id','nombre')->where('convention_id',$id)->get();
        return $ministries;
    }
}
