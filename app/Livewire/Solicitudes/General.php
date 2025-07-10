<?php

namespace App\Livewire\Solicitudes;

use Livewire\Component;
use App\Models\Solicitud;
use App\Models\EstadoSolicitud;

class General extends Component
{
    public $estadoSeleccionado = 'all';
    public $buscado;

    public function render()
    {
        $solicitudes = Solicitud::query()
            ->whereIn('estado_id', [2, 3]) // Filtrar solo aceptadas (2) y rechazadas (3)
            ->when($this->estadoSeleccionado !== 'all', function ($query) {
                $query->where('estado_id', $this->estadoSeleccionado);
            })
            ->when($this->buscado, function ($query) {
                $query->where('acta_id', 'like', '%' . $this->buscado . '%');
            })
            ->paginate(10);

        $estados = EstadoSolicitud::whereIn('id', [2, 3])->get();

        return view('livewire.solicitudes.general', [
            'solicitudes' => $solicitudes,
            'estados' => $estados,
        ]);
    }
}
