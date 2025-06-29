<?php

namespace App\Livewire\Solicitudes;

use App\Models\Acta;
use Livewire\Component;
use App\Models\Solicitud;
use App\Models\EstadoSolicitud;

class Index extends Component
{

    public function render()
    {
        $solicitudes = Solicitud::with('acta')
            ->whereHas('acta', function ($query) {
                $query->where('estado_id', 1);
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        $estados = EstadoSolicitud::all();
        return view('livewire.solicitudes.index'
            , [
                'solicitudes' => $solicitudes,
                'estados' => $estados,
            ]
        );
    }
}
