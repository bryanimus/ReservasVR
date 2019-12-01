<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class CalendarController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
    	$reserva = DB::table('vRESERVA')->where('estado', '4');
        if(auth()->user()->role->visEvenPriv != 1)
            $reserva = $reserva->where('PRIV_EVENTO', 2);
        if(auth()->user()->role->isAdmin != 1)
            $reserva = $reserva->where('CONVENTION_ID', auth()->user()->getConvention());
        $reserva = $reserva->get();

        $data = array();
    	foreach($reserva as $value){
            $color = 'green';
            if ($value->PRIV_EVENTO == 1) $color='purple';

    		$data[] = [
    			'id'   => $value->ID_RESERVA,
				'title'   => $value->NOMBRE_RESERVA,
				'start'   => $value->EVENTO_INICIO,
				'end'   => $value->EVENTO_FIN,
                'color' => $color,
                'textColor' => 'white'
    		];
    	}

    	$data = json_encode($data);
    	return view('calendar.index', [
            'data' => $data
        ]);
    }
}
