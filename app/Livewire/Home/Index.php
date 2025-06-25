<?php

namespace App\Livewire\Home;

use Livewire\Component;
use App\Models\User;
use App\Models\Persona;
use App\Models\ActaDefuncion;
use App\Models\ActaMatrimonio;
use App\Models\ActaNacimiento;

class Index extends Component
{


    public $personas;
    public $defunciones;
    public $matrimonios;
    public $nacimientos;

    public function mount(){
        $this->personas = Persona::all()->count();
        $this->defunciones = ActaDefuncion::all()->count();
        $this->matrimonios = ActaMatrimonio::all()->count();
        $this->nacimientos = ActaNacimiento::all()->count();

    }

    public function placeholder(){
        return view('placeholder');
    }

    public function reiniciar(){
        $this->resetPage();
    }

    public function render()
    {

        return view('livewire.home.index');
    }
}
