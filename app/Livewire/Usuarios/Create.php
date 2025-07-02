<?php

namespace App\Livewire\Usuarios;

use Livewire\Component;
use App\Models\Persona;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class Create extends Component
{
    public $name;
    public $email;
    public $password;
    public $password_confirmation;
    public $persona_id;
    public $ruta_foto;
    public $estado;

    public $nombrePersona = '';
    
    public $personas;


    public function mount()
    {
        $this->personas = Persona::all();
    }

    public function guardarUsuario()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|string|min:8',
            'password_confirmation' => 'required|string|min:8',
            'persona_id' => 'required|exists:personas,id',
            'ruta_foto' => 'nullable|string|max:255',
            'estado' => 'nullable',
        ],[
            'name.required' => 'El nombre es obligatorio.',
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'Debe ingresar un correo válido.',
            'email.unique' => 'El correo electrónico ya está en uso.',
            'password.required' => 'La contraseña es obligatoria.',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
            'password.confirmed' => 'Las contraseñas no coinciden.',
            'password_confirmation.required' => 'Debe confirmar la contraseña.',
            'persona_id.required' => 'Debe seleccionar una persona.',
        ]);

        if(User::where('persona_id', $this->persona_id)->exists()) {
            $this->addError('persona_id', 'Ya existe un usuario registrado con esta persona.');
            return;
        }

        User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => bcrypt($this->password),
            'persona_id' => $this->persona_id,
            'ruta_foto' => $this->ruta_foto,
            'estado' => 1,
        ]);

        session()->flash('message', 'Usuario registrado exitosamente');
        $this->resetForm();
    }

    public function resetForm()
    {
        $this->reset([
            'name',
            'email',
            'password',
            'persona_id',
            'ruta_foto',
            'estado'
        ]);
    }

    public function render()
    {
        return view('livewire.usuarios.create', [
            'personas' => $this->personas,
        ]);

    }
}
