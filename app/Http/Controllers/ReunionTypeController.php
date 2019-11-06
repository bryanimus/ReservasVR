<?php

namespace App\Http\Controllers;
use App\ReunionType;
use Illuminate\Http\Request;
use App\Http\Requests\SaveReunionTypeRequest;

class ReunionTypeController extends Controller
{
    public function __construct(){
        $this->middleware('auth')->except('index', 'show');
    }

    public function index()
    {
        return view('tiposreunion.index', [
            'tiposreunion' => ReunionType::whereNull('estado')->oldest('id')->paginate(10)
        ]);
    }

    public function show(ReunionType $tiporeunion){
        return view('tiposreunion.show', [
            'tiporeunion' => $tiporeunion
        ]);
    }

    public function create(){
        return view('tiposreunion.create', [
            'tiporeunion' => new ReunionType
        ]);
    }

    public function store(SaveReunionTypeRequest $request){
        ReunionType::create($request->validated());

        return redirect()->route('tiporeunion.index')->with('status','El Tipo de Reunión fue Creado con Éxito');
    }

    public function edit(ReunionType $tiporeunion){
        return view('tiposreunion.edit', [
            'tiporeunion' => $tiporeunion
        ]);
    }

    public function update(ReunionType $tiporeunion, SaveReunionTypeRequest $request){
        $tiporeunion->update($request->validated());

        return redirect()->route('tiporeunion.index')->with('status','El Tipo de Reunión fue Actualizado con Éxito');
    }

    public function destroy(ReunionType $tiporeunion){
        $tiporeunion->delete();

        return redirect()->route('tiporeunion.index')->with('status','El Tipo de Reunión fue Eliminado con Éxito');
    }

    public function updateState(ReunionType $tiporeunion){
        $tiporeunion->update(['estado' => 0]);
        return redirect()->route('tiporeunion.index')->with('status','El Tipo de Reunión fue Eliminado con Éxito');
    }
}
