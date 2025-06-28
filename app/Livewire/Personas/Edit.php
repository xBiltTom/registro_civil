<?php

namespace App\Livewire\Personas;

use Livewire\Component;
use App\Models\Persona;
use App\Models\Lugar;

class Edit extends Component
{
    public $id_persona;
    public $dni;
    public $nombre;
    public $apellido;
    public $lugar_id;
    public $sexo;
    public $fecha_nacimiento;
    public $telefono;

    public $lugares;

    public function mount($id)
    {
        $this-> id_persona = $id;
        $persona = Persona::find($this->id_persona);
        if ($persona) {
            $this->dni = $persona->dni;
            $this->nombre = $persona->nombre;
            $this->apellido = $persona->apellido;
            $this->lugar_id = $persona->lugar_id;
            $this->sexo = $persona->sexo;
            $this->fecha_nacimiento = $persona->fecha_nacimiento;
            $this->telefono = $persona->telefono;
        } else {
            session()->flash('error', 'Persona no encontrada');
        }
    }

    public function actualizar()
    {
        $this->validate([
            'dni' => 'nullable|string|max:20|unique:personas,dni,' . $this->id_persona,
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'lugar_id' => 'required|exists:lugar,id',
            'sexo' => 'required|in:M,F',
            'fecha_nacimiento' => 'required|date',
            'telefono' => 'nullable|string|max:9',
        ],[
            'dni.unique' => 'El DNI ya está en uso por otra persona.',
            'lugar_id.exists' => 'El lugar seleccionado no es válido.',
            'sexo.in' => 'El sexo debe ser M (masculino) o F (femenino).',
            'fecha_nacimiento.date' => 'La fecha de nacimiento debe ser una fecha válida.',
        ]);

        $persona = Persona::find($this->id_persona);
        if ($persona) {
            $persona->update([
                'dni' => $this->dni,
                'nombre' => $this->nombre,
                'apellido' => $this->apellido,
                'lugar_id' => $this->lugar_id,
                'sexo' => $this->sexo,
                'fecha_nacimiento' => $this->fecha_nacimiento,
                'telefono' => $this->telefono,
            ]);
            session()->flash('message', 'Persona actualizada exitosamente');
            $this->redirect(route('personas.index', $this->id_persona));
        } else {
            session()->flash('error', 'Persona no encontrada');
        }
    }

    public function render()
    {
        $this->lugares = Lugar::all();
        return view('livewire.personas.edit', [
            'lugares' => $this->lugares,
        ]);
    }

    public function resetForm()
    {
        $this->mount($this->id_persona);
    }
}