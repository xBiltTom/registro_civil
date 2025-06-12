<?php

namespace App\Livewire\Administracion;

use Livewire\Component;
use App\Models\Persona;
use Spatie\Permission\Models\Role;

class AdminIndex extends Component{


    public $personas;
    public $usuarios;
    public $roles;
    public $correo;
    public $contraseña;
    public $user_name;
    public $persona_id;

    public $user;
    public $rol;


    public function placeholder(){
        return view('placeholder');
    }

    public function mount(){
        $this->personas = Persona::all();
    }

    public function registrarUsuario(){
         $this->validate([
            'user_name' => 'required|string|max:255',
            'correo' => 'required|email|max:255|unique:users,email',
            'persona_id' => 'required|exists:personas,id'
        ]);



        $usuario = \App\Models\User::create([
            'name' => $this->user_name,
            'email' => $this->correo,
            'persona_id' => $this->persona_id,
            'ruta_foto' => null,
            'estado' => 1,
            'password' => bcrypt($this->contraseña),
            'email_verified_at' => now(),
        ]);
        /* dd([
            'persona_id' => $this->persona_id,
            'correo' => $this->correo,
            'contraseña' => $this->contraseña,
            'username' => $this->user_name,
            'email_verfied_At'=> now(),
        ]); */


        $this->reset(['user_name', 'correo', 'persona_id', 'contraseña']);
        session()->flash('message', 'Usuario agregado correctamente');

    }

    public function asignarRol(){

        $usuarioAsignado = \App\Models\User::find($this->user);
        $rolAsignado = Role::find($this->rol);
        $usuarioAsignado->assignRole($rolAsignado);

        session()->flash('message', 'Se le asigo al correctamente el rol al usuario');

    }


    public function render()
    {
        $this->roles = \Spatie\Permission\Models\Role::all();
        $this->usuarios = \App\Models\User::all();
        return view('livewire.administracion.admin-index');
    }
}
