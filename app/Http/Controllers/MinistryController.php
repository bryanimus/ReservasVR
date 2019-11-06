<?php

namespace App\Http\Controllers;
use App\Ministry;
use App\Convention;
use Illuminate\Http\Request;
use App\Http\Requests\SaveMinistryRequest;

class MinistryController extends Controller
{
    public function __construct(){
        $this->middleware('auth')->except('index', 'show');
    }

    public function index()
    {
        return view('ministries.index', [
            'ministries' => Ministry::whereNull('estado')->oldest('id')->paginate(10)
        ]);
    }

     public function show(Ministry $ministry){
        return view('ministries.show', [
            'ministry' => $ministry
        ]);
    }

    public function create(){
        $conventions = Convention::whereNull('estado')->pluck('nombre', 'id');
        return view('ministries.create', [
            'ministry' => new Ministry,
            'conventions' => $conventions
        ]);
    }

    public function store(SaveMinistryRequest $request){
        Ministry::create($request->validated());

        return redirect()->route('ministry.index')->with('status','El Ministerio fue Creado con Éxito');
    }

    public function edit(Ministry $ministry){
        $conventions = Convention::whereNull('estado')->pluck('nombre', 'id');
        return view('ministries.edit', [
            'ministry' => $ministry,
            'conventions' => $conventions
        ]);
    }

    public function update(Ministry $ministry, SaveMinistryRequest $request){
        $ministry->update($request->validated());

        return redirect()->route('ministry.index')->with('status','El Ministerio fue Actualizado con Éxito');
    }

    public function destroy(Ministry $ministry){
        $ministry->delete();

        return redirect()->route('ministry.index')->with('status','El Ministerio fue Eliminado con Éxito');
    }

    public function updateState(Ministry $ministry){
        $ministry->update(['estado' => 0]);
        return redirect()->route('ministry.index')->with('status','El Ministerio fue Eliminado con Éxito');
    }
}
