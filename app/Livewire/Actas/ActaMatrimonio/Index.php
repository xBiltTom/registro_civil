<?php

namespace App\Livewire\ActaMatrimonio;

use Livewire\Component;
use App\Models\ActaMatrimonio;
use App\Models\Persona;

class Index extends Component
{

    public $actasMatrimonios;

    public function placeholder(){
        return view('placeholder');
    }

    public function render()
    {

        $actasMatrimonios = ActaMatrimonio::with(['novio_id', 'novia_id'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        return view('livewire.actas.acta-matrimonio.index');
    }
}
