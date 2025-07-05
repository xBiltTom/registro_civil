<?php

namespace App\Livewire\Solicitudes;

use App\Models\Solicitud;
use Livewire\Component;
use Livewire\WithPagination;
class Historial extends Component
{
    use WithPagination;

    protected $paginationTheme = 'tailwind';
    public function render()
    {
        $funcionario = auth()->user();
        $solicitudes = Solicitud::where('funcionario_id','=',$funcionario->id)->paginate(7);
        return view('livewire.solicitudes.historial',compact('solicitudes'));
    }
}
