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
            'ministries' => Ministry::oldest('id')->paginate(10)
        ]);
    }

     public function show(Ministry $ministry){
        return view('ministries.show', [
            'ministry' => $ministry
        ]);
    }

    public function create(){
        $conventions = Convention::pluck('nombre', 'id');
        return view('ministries.create', [
            'ministry' => new Ministry,
            'conventions' => $conventions
        ]);
    }

    public function store(SaveMinistryRequest $request){
        Ministry::create($request->validated());

        return redirect()->route('ministry.index')->with('status','El ministerio fue creado con exito');
    }

    public function edit(Ministry $ministry){
        $conventions = Convention::pluck('nombre', 'id');
        return view('ministries.edit', [
            'ministry' => $ministry,
            'conventions' => $conventions
        ]);
    }

    public function update(Ministry $ministry, SaveMinistryRequest $request){
        $ministry->update($request->validated());

        return redirect()->route('ministry.index')->with('status','El ministerio fue actualizado con exito');
    }

    public function destroy(Ministry $ministry){
        $ministry->delete();

        return redirect()->route('ministry.index')->with('status','El ministerio fue eliminado con exito');
    }
}
