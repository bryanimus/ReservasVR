<?php

namespace App\Http\Controllers;
use App\Salon;
use App\Convention;
use Illuminate\Http\Request;
use App\Http\Requests\SaveSalonRequest;

class SalonController extends Controller
{
    public function __construct(){
        $this->middleware('auth')->except('index', 'show');
    }

    public function index()
    {
    	return view('salones.index', [
            'salones' => Salon::oldest('id')->paginate(10)
        ]);
    }

    public function edit(Salon $salon){
        $conventions = Convention::pluck('nombre', 'id');
        return view('salones.edit', [
            'salon' => $salon,
            'conventions' => $conventions
        ]);
    }

    public function create(){
        $conventions = Convention::pluck('nombre', 'id');
        return view('salones.create', [
            'salon' => new Salon,
            'conventions' => $conventions
        ]);
    }

    public function store(SaveSalonRequest $request){
        Salon::create($request->validated());

        return redirect()->route('salon.index')->with('status','El salon fue creado con exito');
    }

    public function update(Salon $salon, SaveSalonRequest $request){
       $salon->update($request->validated());

       return redirect()->route('salon.index')->with('status','El salon fue actualizado con exito');
    }

    public function destroy(Salon $salon){
        $salon->delete();

        return redirect()->route('salon.index')->with('status','El salon fue eliminado con exito');
    }
}
