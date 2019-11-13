<?php

namespace App\Http\Controllers;
use App\Salon;
use App\Convention;
use Illuminate\Http\Request;
use App\Http\Requests\SaveSalonRequest;

class SalonController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('checkRole:accSalones');
    }

    public function index()
    {
    	return view('salones.index', [
            'salones' => Salon::whereNull('estado')->oldest('id')->paginate(10)
        ]);
    }

    public function edit(Salon $salon){
        $conventions = Convention::whereNull('estado')->pluck('nombre', 'id');
        return view('salones.edit', [
            'salon' => $salon,
            'conventions' => $conventions
        ]);
    }

    public function create(){
        $conventions = Convention::whereNull('estado')->pluck('nombre', 'id');
        return view('salones.create', [
            'salon' => new Salon,
            'conventions' => $conventions
        ]);
    }

    public function store(SaveSalonRequest $request){
        Salon::create($request->validated());

        return redirect()->route('salon.index')->with('status','El Salón fue Creado con Éxito');
    }

    public function update(Salon $salon, SaveSalonRequest $request){
       $salon->update($request->validated());

       return redirect()->route('salon.index')->with('status','El Salón fue Actulizado con Éxito');
    }

    public function destroy(Salon $salon){
        $salon->delete();

        return redirect()->route('salon.index')->with('status','El Salón fue Eliminado con Éxito');
    }

    public function updateState(Salon $salon){
        $salon->update(['estado' => 0]);
        return redirect()->route('salon.index')->with('status','El Salón fue Eliminado con Éxito');
    }
}
