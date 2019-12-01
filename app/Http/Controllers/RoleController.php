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
        $this->middleware('auth');
        $this->middleware('checkRole:accRol');
    }

    public function index()
    {
        return view('roles.index', [
            'roles' => Role::whereNull('estado')->orderBy('nombre')->oldest('id')->paginate(10)
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
        $isAdmin = 0; if (isset($request->isAdmin)) $isAdmin = 1;
        $accCentConv = 0; if (isset($request->accCentConv)) $accCentConv = 1;
        $accMinisterio = 0; if (isset($request->accMinisterio)) $accMinisterio = 1;
        $accSalones = 0; if (isset($request->accSalones)) $accSalones = 1;
        $accTipoReunion = 0; if (isset($request->accTipoReunion)) $accTipoReunion = 1;
        $accRecurso = 0; if (isset($request->accRecurso)) $accRecurso = 1;
        $accRol = 0; if (isset($request->accRol)) $accRol = 1;
        $accUsuario = 0; if (isset($request->accUsuario)) $accUsuario = 1;
        $opcSolicitar = 0; if (isset($request->opcSolicitar)) $opcSolicitar = 1;
        $opcAprobar = 0; if (isset($request->opcAprobar)) $opcAprobar = 1;
        $opcReserva = 0; if (isset($request->opcReserva)) $opcReserva = 1;
        $visEvenPriv = 0; if (isset($request->visEvenPriv)) $visEvenPriv = 1;
        $accDepto = 0; if (isset($request->accDepto)) $accDepto = 1;
        $dataInsert = [
            'nombre' => $request->nombre, 'descripcion' => $request->descripcion, 'accCentConv' => $accCentConv, 'accMinisterio' => $accMinisterio, 'accSalones' => $accSalones,
            'accTipoReunion' => $accTipoReunion, 'accRecurso' => $accRecurso, 'accRol' => $accRol, 'accUsuario' => $accUsuario, 'opcReserva' => $opcReserva, 'opcAprobar' => $opcAprobar,
            'visEvenPriv' => $visEvenPriv, 'opcSolicitar' => $opcSolicitar, 'isAdmin' => $isAdmin, 'accDepto' => $accDepto
        ];
        Role::create($dataInsert);

        return redirect()->route('role.index')->with('status','El Rol fue Creado con Éxito');
    }

    public function edit(Role $role){
        return view('roles.edit', [
            'role' => $role
        ]);
    }

    public function update(Role $role, SaveRoleRequest $request){
        $isAdmin = 0; if (isset($request->isAdmin)) $isAdmin = 1;
        $accCentConv = 0; if (isset($request->accCentConv)) $accCentConv = 1;
        $accMinisterio = 0; if (isset($request->accMinisterio)) $accMinisterio = 1;
        $accSalones = 0; if (isset($request->accSalones)) $accSalones = 1;
        $accTipoReunion = 0; if (isset($request->accTipoReunion)) $accTipoReunion = 1;
        $accRecurso = 0; if (isset($request->accRecurso)) $accRecurso = 1;
        $accRol = 0; if (isset($request->accRol)) $accRol = 1;
        $accUsuario = 0; if (isset($request->accUsuario)) $accUsuario = 1;
        $opcSolicitar = 0; if (isset($request->opcSolicitar)) $opcSolicitar = 1;
        $opcAprobar = 0; if (isset($request->opcAprobar)) $opcAprobar = 1;
        $opcReserva = 0; if (isset($request->opcReserva)) $opcReserva = 1;
        $visEvenPriv = 0; if (isset($request->visEvenPriv)) $visEvenPriv = 1;
        $accDepto = 0; if (isset($request->accDepto)) $accDepto = 1;
        $dataUpdate = [
            'nombre' => $request->nombre, 'descripcion' => $request->descripcion, 'accCentConv' => $accCentConv, 'accMinisterio' => $accMinisterio, 'accSalones' => $accSalones,
            'accTipoReunion' => $accTipoReunion, 'accRecurso' => $accRecurso, 'accRol' => $accRol, 'accUsuario' => $accUsuario, 'opcReserva' => $opcReserva, 'opcAprobar' => $opcAprobar,
            'visEvenPriv' => $visEvenPriv, 'opcSolicitar' => $opcSolicitar, 'isAdmin' => $isAdmin, 'accDepto' => $accDepto
        ];

        $role->update($dataUpdate);

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
