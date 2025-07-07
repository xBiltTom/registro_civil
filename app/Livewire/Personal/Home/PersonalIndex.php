<?php

namespace App\Livewire\Personal\Home;

use Livewire\Component;
use App\Models\Persona;
use App\Models\Acta;
use App\Models\Solicitud;

class PersonalIndex extends Component
{
    public $cantidadActas;
    public $cantidadSolicitudes;

    public function mount()
    {
        $usuario = auth()->user();
        $persona = Persona::find($usuario->persona_id);

        $this->cantidadActas = Acta::where(function ($query) use ($persona) {
            $query->whereHas('actaNacimiento', function ($q) use ($persona) {
                $q->where('nacido_id', $persona->id)
                    ->orWhere('padre_id', $persona->id)
                    ->orWhere('madre_id', $persona->id);
            })->orWhereHas('actaMatrimonio', function ($q) use ($persona) {
                $q->where('novio_id', $persona->id)
                    ->orWhere('novia_id', $persona->id)
                    ->orWhere('testigo1_id', $persona->id)
                    ->orWhere('testigo2_id', $persona->id);
            })->orWhereHas('actaDefuncion', function ($q) use ($persona) {
                $q->where('declarante_id', $persona->id);
            });
        })->count();

        $this->cantidadSolicitudes = Solicitud::where('user_id', $usuario->id)->count();
    }

    public function render()
    {
        return view('livewire.personal.home.personal-index');
    }
}
