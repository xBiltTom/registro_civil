<?php

namespace App\Livewire\Personal;

use Livewire\Component;
use App\Models\Persona;
use App\Models\User;
use App\Models\Lugar;

class Selfinfo extends Component
{

    public $persona;
    public $dni;
    public $nombre;
    public $fecha_nacimiento;
    public $sexo;
    public $lugar;
    public $telefono;
    public $estado_civil;

    public function mount(){
        $this->persona = Persona::find(auth()->user()->persona_id);
        $this->dni = $this->persona->dni;
        $this->nombre = $this->persona->nombre . ' ' . $this->persona->apellido;
        $this->lugar = $this->persona->lugar_id;
        $this->sexo = $this->persona->sexo;
        $this->fecha_nacimiento = $this->persona->fecha_nacimiento;
        $this->estado_civil = $this->persona->estado_civil;
        $this->telefono = $this->persona->telefono;
        $this->lugar = Lugar::find($this->persona->lugar_id);
    }

    public function render()
    {
        return view('livewire.personal.selfinfo');
    }
}
