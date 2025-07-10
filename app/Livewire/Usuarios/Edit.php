<?php

namespace App\Livewire\Usuarios;

use Livewire\Component;
use App\Models\User;
use App\Models\Persona;

class Edit extends Component
{
    use \Livewire\WithFileUploads;

    public $id_usuario;
    public $name;
    public $email;
    public $password;
    public $password_confirmation;
    public $persona_id;
    public $ruta_foto;
    public $estado;
    public $nombrePersona = '';

    public $personas;

    public function mount($id)
    {
        $this->id_usuario = $id;
        $usuario = User::find($this->id_usuario);

        if ($usuario) {
            $this->name = $usuario->name;
            $this->email = $usuario->email;
            $this->persona_id = $usuario->persona_id;
            $this->ruta_foto = $usuario->ruta_foto;
            $this->estado = $usuario->estado;
            $this->nombrePersona = optional($usuario->persona)->nombre . ' ' . optional($usuario->persona)->apellido;
        } else {
            session()->flash('error', 'Usuario no encontrado');
        }
    }

    public function actualizar()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $this->id_usuario,
            'password' => 'nullable|string|min:8|confirmed',
            'persona_id' => 'required|exists:personas,id',
            //'ruta_foto' => 'nullable|image|max:2048',
            'estado' => 'required|in:0,1',
        ], [
            'name.required' => 'El nombre es obligatorio.',
            'name.string' => 'El nombre debe ser un texto válido.',
            'name.max' => 'El nombre no debe superar los 255 caracteres.',
            
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'Debe ingresar un correo electrónico válido.',
            'email.max' => 'El correo electrónico no debe superar los 255 caracteres.',
            'email.unique' => 'El correo electrónico ya está en uso por otro usuario.',

            'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
            'password.confirmed' => 'Las contraseñas no coinciden.',
            'password.string' => 'La contraseña debe ser un texto válido.',
            
            'persona_id.required' => 'Debe seleccionar una persona.',
            'persona_id.exists' => 'La persona seleccionada no existe.',

            'ruta_foto.image' => 'El archivo debe ser una imagen.',
            'ruta_foto.max' => 'La imagen no puede exceder los 2MB.',
            
            'estado.in' => 'El estado debe ser 0 (inactivo) o 1 (activo).',
        ]);

        if (User::where('persona_id', $this->persona_id)
            ->where('id', '!=', $this->id_usuario)
            ->exists()) {
            $this->addError('persona_id', 'Ya existe un usuario registrado con esta persona.');
            return;
        }

        $usuario = User::find($this->id_usuario);
        if ($usuario) {
            $rutaFoto = $usuario->ruta_foto;
            if ($this->ruta_foto && is_object($this->ruta_foto)) {
                $rutaFoto = $this->ruta_foto->store('usuarios', 'public');
            }
            $data = [
                'name' => $this->name,
                'email' => $this->email,
                'persona_id' => $this->persona_id,
                'ruta_foto' => $rutaFoto,
                'estado' => $this->estado,
            ];

            if (!empty($this->password)) {
                $data['password'] = bcrypt($this->password);
            }

            $usuario->update($data);

            session()->flash('message', 'Usuario actualizado correctamente');
            return redirect()->route('usuarios.index');
        } else {
            session()->flash('error', 'Usuario no encontrado');
        }
    }

    public function render()
    {
        $this->personas = Persona::all();
        return view('livewire.usuarios.edit', [
            'personas' => $this->personas,
        ]);
    }

    public function resetForm()
    {
        $this->mount($this->id_usuario);
    }
}
