<?php

namespace App\Http\Controllers;
use App\Role;
use Illuminate\Http\Request;
use App\Http\Requests\SaveRoleRequest;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(){
        $this->middleware('auth')->except('index', 'show');
    }

    public function index()
    {
        return view('roles.index', [
            'roles' => Role::whereNull('estado')->oldest('id')->paginate(10)
        ]);
    }

    public function show(Role $role){
        return view('roles.show', [
            'role' => $role
        ]);
    }

    public function create(){
        return view('roles.create', [
            'role' => new Role
        ]);
    }

    public function store(SaveRoleRequest $request){
        Role::create($request->validated());

        return redirect()->route('role.index')->with('status','El Rol fue Creado con Éxito');
    }

    public function edit(Role $role){
        return view('roles.edit', [
            'role' => $role
        ]);
    }

    public function update(Role $role, SaveRoleRequest $request){
        $role->update($request->validated());

        return redirect()->route('role.index')->with('status','El Rol fue Actulizado con Éxito');
    }

    public function destroy(Role $role){
        $role->delete();

        return redirect()->route('role.index')->with('status','El Rol fue Eliminado con Éxito');
    }

    public function updateState(Role $role){
        $role->update(['estado' => 0]);
        return redirect()->route('role.index')->with('status','El Rol fue Eliminado con Éxito');
    }
}
