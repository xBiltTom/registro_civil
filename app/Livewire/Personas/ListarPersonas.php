<?php

namespace App\Livewire\Personas;

use Livewire\Component;
use App\Models\Persona;

class ListarPersonas extends Component
{

    public $personas;

    public function mount(){
        $personas = Persona::all();
        return $this->personas = $personas;
    }

    public function placeholder(){
        return view('placeholder');
    }

    public function render()
    {
        return view('livewire.personas.listar-personas');
    }
}
