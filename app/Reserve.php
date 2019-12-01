<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Reserve extends Model
{
    protected $guarded = [];
	protected $table = 'reserves';

	public function convention(){
        return $this->belongsTo(Convention::class);
    }

    public function salonesReserva(){
        $salones = DB::table('vRESERVASALON')->where('RESERVE_ID', $this->id)->orderBy('SALON')->get();
        return $salones;
    }

    public function descEstado()
    {
        $desc = '';
        switch($this->estado){
            case 1:
                $desc = 'En Solicitud';
                break;
            case 2:
                $desc = 'Rechazado';
                break;
            case 3:
                $desc = 'Aprobado';
                break;
            case 4:
                $desc = 'Reservado';
                break;
            case 5:
                $desc = 'Finalizado';
                break;
            case 6:
                $desc = 'Evaluado';
                break;
            case 7:
                $desc = 'Eliminado';
                break;
        }
        return $desc;
    }

    public function usuario($id){
        $usuario = User::find($id);
        return $usuario->name;
    }
}
