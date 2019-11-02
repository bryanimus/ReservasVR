<?php

namespace App\Http\Controllers;
use App\User;
use App\Role;
use App\Ministry;
use Illuminate\Http\Request;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\SaveUserRequest;

class UserController extends Controller
{
    public function __construct(){
        $this->middleware('auth')->except('index', 'show');
    }

    public function index()
    {
    	return view('users.index', [
            'users' => User::oldest('id')->paginate(10)
        ]);
    }

    public function edit(User $user){
        $roles = Role::pluck('nombre', 'id');
        $ministries = Ministry::pluck('nombre', 'id');
        return view('users.edit', [
            'user' => $user,
            'roles' => $roles,
            'ministries' => $ministries
        ]);
    }

    public function create(){
        $roles = Role::pluck('nombre', 'id');
        $ministries = Ministry::pluck('nombre', 'id');
        return view('users.create', [
            'user' => new User,
            'roles' => $roles,
            'ministries' => $ministries
        ]);
    }

    public function store(CreateUserRequest $request){
        User::create($request->validated());

        return redirect()->route('user.index')->with('status','El usuario fue creado con exito');
    }

    public function update(User $user, SaveUserRequest $request){
       $user->update($request->validated());

       return redirect()->route('user.index')->with('status','El usuario fue actualizado con exito');
    }

    public function destroy(User $user){
        $user->delete();

        return redirect()->route('user.index')->with('status','El usuario fue eliminado con exito');
    }
}
