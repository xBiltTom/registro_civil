<?php

namespace App\Livewire\Pagos;

use App\Models\Pago;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $mostrarModalVoucher = false;
    public $pagoSeleccionado = null;

    public function abrirModalVoucher($id)
    {
        $this->pagoSeleccionado = Pago::find($id);
        $this->mostrarModalVoucher = true;
    }

    public function cerrarModalVoucher()
    {
        $this->mostrarModalVoucher = false;
        $this->pagoSeleccionado = null;
    }

    public function render()
    {
        $pagos = Pago::whereHas('solicitud', function($query) {
            $query->where('estado_id', 2); // Asumiendo que 2 es el ID del estado "aceptado"
        })
        ->with(['solicitud.user.persona']) // Cargamos las relaciones para evitar el error null
        ->latest() // Ordenar por fecha de creación, más reciente primero
        ->paginate(5);

        return view('livewire.pagos.index', [
            "pagos" => $pagos,
        ]);
    }
}
