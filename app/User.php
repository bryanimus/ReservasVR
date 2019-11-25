<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role_id', 'ministry_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function role(){
        return $this->belongsTo(Role::class);
    }

    public function accOpcion($opcion){
        $accOpcion = false;
        if ($this->role_id){
            $role = Role::where('id', $this->role_id)->where($opcion,'1')->get();
            if (count($role)) $accOpcion = true;
        }
        return $accOpcion;
    }

    public function accParametrizacion(){
        $accParametrizacion = false;
        if ($this->role_id){
            $role = Role::find($this->role_id);
            if ($role->accCentConv || $role->accMinisterio || $role->accSalones || $role->accDepto || $role->accTipoReunion ||  $role->accRecurso)
                $accParametrizacion = true;
        }
        return $accParametrizacion;
    }

    public function accOperacion(){
        $accOperacion = false;
        if ($this->role_id){
            $role = Role::find($this->role_id);
            if ($role->opcReserva || $role->opcAprobar)
                $accOperacion = true;
        }
        return $accOperacion;
    }

    public function accSeguridad(){
        $accSeguridad = false;
        if ($this->role_id){
            $role = Role::find($this->role_id);
            if ($role->accRol || $role->accUsuario)
                $accSeguridad = true;
        }
        return $accSeguridad;
    }

    public function setPasswordAttribute($password){
        $this->attributes['password'] = bcrypt($password);
    }

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
