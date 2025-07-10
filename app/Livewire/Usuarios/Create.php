<?php

namespace App\Livewire\Usuarios;

use Livewire\Component;
use App\Models\Persona;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\WithFileUploads;
class Create extends Component
{
    use WithFileUploads;
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
        logger('Método guardarUsuario iniciado');
        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'persona_id' => 'required|exists:personas,id',
            'ruta_foto' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'estado' => 'nullable',
        ],[
            'name.required' => 'El nombre es obligatorio.',
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'Debe ingresar un correo válido.',
            'email.unique' => 'El correo electrónico ya está en uso.',
            'password.required' => 'La contraseña es obligatoria.',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
            'password.confirmed' => 'Las contraseñas no coinciden.',
            'persona_id.required' => 'Debe seleccionar una persona.',
            'ruta_foto.max' => 'La imagen no puede exceder los 2MB.',
            'ruta_foto.mimes' => 'La imagen debe ser un archivo de tipo: jpg, jpeg, png, pdf.',
            'ruta_foto.file' => 'La ruta de la foto debe ser un archivo.',
        ]);

        logger('Validación completada');

        if(User::where('persona_id', $this->persona_id)->exists()) {
            logger('Persona ya tiene usuario');
            $this->addError('persona_id', 'Ya existe un usuario registrado con esta persona.');
            return;
        }
        logger('Antes de almacenar archivo');
        $rutaFoto = $this->ruta_foto ? $this->ruta_foto->store('usuarios', 'public') : null;
        
        logger('Ruta Foto: ' . $rutaFoto);
        User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => bcrypt($this->password),
            'persona_id' => $this->persona_id,
            'ruta_foto' => $rutaFoto,
            'estado' => 1,
        ]);
        session()->flash('message', 'Usuario registrado exitosamente');
        $this->resetForm();
        return $this->redirect(route('usuarios.index'));
    }

    public function resetForm()
    {
        $this->reset([
            'name',
            'email',
            'password',
            'password_confirmation',
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
