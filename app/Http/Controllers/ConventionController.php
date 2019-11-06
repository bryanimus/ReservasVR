<?php

namespace App\Http\Controllers;
use App\Convention;
use Illuminate\Http\Request;
use App\Http\Requests\SaveConventionRequest;

class ConventionController extends Controller
{
    public function __construct(){
        $this->middleware('auth')->except('index', 'show');
    }

    public function index()
    {
    	return view('conventions.index', [
            'conventions' => Convention::whereNull('estado')->oldest('id')->paginate(10)
        ]);
    }

    public function edit(Convention $convention){
        return view('conventions.edit', [
            'convention' => $convention,
        ]);
    }

    public function create(){
        return view('conventions.create', [
            'convention' => new Convention
        ]);
    }

    public function store(SaveConventionRequest $request){
        Convention::create($request->validated());

        return redirect()->route('convention.index')->with('status','El Centro de Convención fue Creado con Éxito');
    }

    public function update(Convention $convention, SaveConventionRequest $request){
       $convention->update($request->validated());

       return redirect()->route('convention.index')->with('status','El Centro de Convención fue Actualizado con Éxito');
    }

    public function destroy(Convention $convention){
        $convention->delete();

        return redirect()->route('convention.index')->with('status','El centro de convencion fue eliminado con exito');
    }

    public function updateState(Convention $convention){
        $convention->update(['estado' => 0]);
        return redirect()->route('convention.index')->with('status','El Centro de Convención fue Eliminado con Éxito');
    }
}
