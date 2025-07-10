<?php

namespace App\Livewire\Solicitudes;

use App\Models\Solicitud;
use Livewire\Component;

class Vista extends Component
{
    public $solicitud;

    public function mount($id)
    {
        $this->solicitud = Solicitud::find($id);
    }

    public function render()
    {

        return view('livewire.solicitudes.vista');
    }
}
