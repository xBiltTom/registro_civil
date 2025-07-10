<?php

namespace App\Livewire\Solicitudes;

use Livewire\Component;
use App\Models\Solicitud;

class VerSolicitud extends Component
{
    /* public $acta; */

    public $solicitud;

    public function mount($id)
    {
        /* $this->acta = Solicitud::with(['folio', 'tipo'])->findOrFail($id); */

        $this->solicitud = Solicitud::find($id);
    }

    public function render()
    {
        return view('livewire.solicitudes.ver', [
            /* 'acta' => $this->acta, */
        ]);
    }
}
