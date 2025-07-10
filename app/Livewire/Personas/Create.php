<?php

namespace App\Livewire\Personas;

use Livewire\Component;
use App\Models\Persona;
use App\Models\Lugar;
use Illuminate\Support\Facades\Auth;

class Create extends Component
{
    public $dni;
    public $nombre;
    public $apellido;
    public $lugar_id;
    public $sexo;
    public $fecha_nacimiento;
    public $telefono;
    
    public $lugares;

    public function mount()
    {
        $this->lugares = Lugar::all();
    }

    public function guardarPersona()
    {
        $this->validate([
            'dni' => 'nullable|string|max:20|unique:personas,dni',
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'lugar_id' => 'required|exists:lugar,id',
            'sexo' => 'required|in:M,F',
            'fecha_nacimiento' => 'required|date',
            'telefono' => 'nullable|string|max:9',
        ],[
            'dni.unique' => 'El DNI ya está registrado.',
            'dni.max' => 'El DNI no puede tener más de 20 caracteres.',
            'nombre.required' => 'El campo Nombre es obligatorio.',
            'nombre.max' => 'El Nombre no puede tener más de 255 caracteres.',
            'apellido.required' => 'El campo Apellido es obligatorio.',
            'apellido.max' => 'El Apellido no puede tener más de 255 caracteres.',
            'lugar_id.required' => 'El campo Lugar es obligatorio.',
            'sexo.required' => 'El campo Sexo es obligatorio.',
            'fecha_nacimiento.required' => 'La fecha de nacimiento es obligatoria.',
            'telefono.max' => 'El teléfono no puede tener más de 9 dígitos.',
        ]);

        Persona::create([
            'dni' => $this->dni,
            'nombre' => $this->nombre,
            'apellido' => $this->apellido,
            'lugar_id' => $this->lugar_id,
            'sexo' => $this->sexo,
            'fecha_nacimiento' => $this->fecha_nacimiento,
            'telefono' => $this->telefono,

        ]);

        session()->flash('message', 'Persona registrada exitosamente');
        $this->resetForm();
    }

    public function resetForm()
    {
        $this->reset(['dni', 'nombre', 'apellido', 'lugar_id', 'sexo', 'fecha_nacimiento', 'telefono']);
    }

    public function render()
    {
        return view('livewire.personas.create', [
            'lugares' => $this->lugares,
        ]);

    }
}
