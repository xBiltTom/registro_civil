<?php

namespace App\Livewire\Solicitudes;

use Livewire\Component;
use App\Models\Solicitud; // Importar el modelo de Solicitud
use App\Models\EstadoSolicitud; // Importar el modelo de Estado

class General extends Component
{
    public $estadoSeleccionado = 'all'; // 'all', '2' (Aceptadas), '3' (Rechazadas)
    public $buscado; // Número de acta a buscar

    public function render()
    {
        $solicitudes = Solicitud::query()
            ->whereIn('estado_id', [2, 3]) // Filtrar solo aceptadas (2) y rechazadas (3)
            ->when($this->estadoSeleccionado !== 'all', function ($query) {
                $query->where('estado_id', $this->estadoSeleccionado);
            })
            ->when($this->buscado, function ($query) {
                $query->where('acta_id', 'like', '%' . $this->buscado . '%'); // Filtrar por número de acta
            })
            ->paginate(10);

        $estados = EstadoSolicitud::whereIn('id', [2, 3])->get(); // Obtener solo estados aceptados y rechazados

        return view('livewire.solicitudes.general', [
            'solicitudes' => $solicitudes,
            'estados' => $estados,
        ]);
    }
}
