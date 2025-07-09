<?php

namespace App\Livewire\Solicitudes;

use App\Models\Solicitud;
use Livewire\Component;

class Contador extends Component
{


    public $solicitudesPendientes = 0;

    public function mount()
    {
        $this->cargarSolicitudesPendientes();
    }

    public function cargarSolicitudesPendientes()
    {
        $this->solicitudesPendientes = Solicitud::where('estado_id', 1)->count();
    }

    public function nuevaSolicitud()
    {
        
    }

    public function render()
    {
        return view('livewire.solicitudes.contador');
    }
}
