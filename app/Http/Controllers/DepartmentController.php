<?php

namespace App\Http\Controllers;
use App\Department;
use App\Convention;
use Illuminate\Http\Request;
use App\Http\Requests\SaveDepartmentRequest;

class DepartmentController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('checkRole:accDepto');
    }

    public function index()
    {
    	return view('departments.index', [
            'departments' => Department::whereNull('estado')->orderBy('nombre')->oldest('id')->paginate(10)
        ]);
    }

    public function edit(Department $department){
        $conventions = Convention::whereNull('estado')->orderBy('nombre')->pluck('nombre', 'id');
        return view('departments.edit', [
            'department' => $department,
            'conventions' => $conventions
        ]);
    }

    public function create(){
        $conventions = Convention::whereNull('estado')->orderBy('nombre')->pluck('nombre', 'id');
        return view('departments.create', [
            'department' => new Department,
            'conventions' => $conventions
        ]);
    }

    public function store(SaveDepartmentRequest $request){
        Department::create($request->validated());

        return redirect()->route('department.index')->with('status','El Departamento fue Creado con Éxito');
    }

    public function update(Department $department, SaveDepartmentRequest $request){
       $department->update($request->validated());

       return redirect()->route('department.index')->with('status','El Departamento fue Actulizado con Éxito');
    }

    public function destroy(Department $department){
        $department->delete();

        return redirect()->route('department.index')->with('status','El Departamento fue Eliminado con Éxito');
    }

    public function updateState(Department $department){
        $department->update(['estado' => 0]);
        return redirect()->route('department.index')->with('status','El Departamento fue Eliminado con Éxito');
    }
}
