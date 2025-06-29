<?php

namespace App\Livewire\Personal\Solicitudes;

use App\Models\Persona;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Solicitud;

class Index extends Component
{

    use WithPagination;

    protected $paginationTheme = 'tailwind';

    public $buscado;
    public $tipoSeleccionado = 'all'; // valor por defecto

    public function placeholder(){
        return view('placeholder');
    }

    public function reiniciar(){
        $this->resetPage();
    }


    public function render(){
        $usuario = auth()->user();

        // Obtener todas las solicitudes donde el user_id coincida con el ID del usuario autenticado
        $solicitudes = Solicitud::where('user_id', $usuario->id)->paginate(5);

        return view('livewire.personal.solicitudes.index', compact('solicitudes'));
    }
}
