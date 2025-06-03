<?php

namespace App\Livewire\ActaMatrimonio;

use Livewire\Component;
use App\Models\ActaMatrimonio;
use App\Models\Persona;

class Crear extends Component
{



    public function placeholder(){
        return view('placeholder');
    }

    public function render()
    {

        return view('livewire.actas.acta-matrimonio.create');
    }
}
