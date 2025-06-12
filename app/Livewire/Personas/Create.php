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
