<?php

namespace App\Livewire\Administracion;

use Livewire\Component;
use App\Models\Persona;
use Spatie\Permission\Models\Role;
use Illuminate\Validation\Rules;

class AdminIndex extends Component{


    public $personas;
    public $usuarios;
    public $roles;
    public $correo;
    public $password;
    public $password_confirmation;
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
            'persona_id' => 'required|exists:personas,id|unique:users,persona_id',
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
            'password_confirmation' => 'required|string',
        ], [
            'user_name.required' => 'El nombre de usuario es obligatorio.',
            'user_name.max' => 'El nombre de usuario no debe superar los 255 caracteres.',
            
            'correo.required' => 'El correo electrónico es obligatorio.',
            'correo.email' => 'El correo electrónico no tiene un formato válido.',
            'correo.unique' => 'Este correo ya está registrado.',

            'persona_id.required' => 'Debe seleccionar una persona.',
            'persona_id.exists' => 'La persona seleccionada no existe.',
            'persona_id.unique' => 'Esta persona ya tiene un usuario asociado.',

            'password.required' => 'La contraseña es obligatoria.',
            'password.confirmed' => 'La confirmación de la contraseña no coincide.',
            'password_confirmation.required' => 'Debe confirmar la contraseña.',
        ]);

        $usuario = \App\Models\User::create([
            'name' => $this->user_name,
            'email' => $this->correo,
            'persona_id' => $this->persona_id,
            'ruta_foto' => null,
            'estado' => 1,
            'password' => bcrypt($this->password),
            'email_verified_at' => now(),
        ]);

        $this->reset(['user_name', 'correo', 'persona_id', 'password', 'password_confirmation']);
        session()->flash('message', 'Usuario agregado correctamente');

    }

    public function asignarRol(){

        $usuarioAsignado = \App\Models\User::find($this->user);
        $rolAsignado = Role::find($this->rol);
        $usuarioAsignado->syncRoles([$rolAsignado]);  //En lugar de assign, ya que sync elimina los roles antiguos antes de asignar uno nuevo

        session()->flash('message', 'Se le asigno el rol correctamente  al usuario');

    }


    public function render()
    {
        $this->roles = \Spatie\Permission\Models\Role::all();
        $this->usuarios = \App\Models\User::all();
        return view('livewire.administracion.admin-index');
    }
}
