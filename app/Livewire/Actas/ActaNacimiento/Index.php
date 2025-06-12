<?php

namespace App\Livewire\Actas\ActaNacimiento;

use Livewire\Component;
use App\Models\ActaNacimiento;

class Index extends Component
{

    public function placeholder(){
        return view('placeholder');
    }

    public function render()
    {


        return view('livewire.actas.acta-nacimiento.index', [

        ]);
    }

}
