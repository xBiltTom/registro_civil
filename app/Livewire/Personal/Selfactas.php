<?php

namespace App\Livewire\Personal;

use Livewire\Component;
use App\Models\Persona;
use App\Models\Acta;
use App\Models\TipoActa;
use Livewire\WithPagination;

class Selfactas extends Component
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

    public function render()
    {
        $usuario = auth()->user();
        $persona = Persona::find($usuario->persona_id);

        // Consulta base para obtener las actas relacionadas con la persona
        $query = Acta::with(['tipo', 'actaNacimiento', 'actaMatrimonio', 'actaDefuncion'])
            ->where(function ($query) use ($persona) {
                $query->whereHas('actaNacimiento', function ($query) use ($persona) {
                    $query->where('nacido_id', $persona->id) // Cambiado de persona_id a nacido_id
                ->orWhere('padre_id', $persona->id)
                ->orWhere('madre_id', $persona->id);
                })
                ->orWhereHas('actaMatrimonio', function ($query) use ($persona) {
                    $query->where('novio_id', $persona->id)
                        ->orWhere('novia_id', $persona->id)
                        ->orWhere('testigo1_id', $persona->id)
                        ->orWhere('testigo2_id', $persona->id);
                })
                ->orWhereHas('actaDefuncion', function ($query) use ($persona) {
                    $query->where('declarante_id', $persona->id);
                });
            });

        // Filtrar por tipo seleccionado
        if ($this->tipoSeleccionado !== 'all') {
            $query->where('tipo_id', $this->tipoSeleccionado);
        }

        // Aplicar búsqueda dentro de los datos filtrados
        if ($this->buscado) {
            $query->where('id', 'like', '%' . $this->buscado . '%');
        }

        // Paginación de los resultados
        $actas = $query->paginate(5);

        // Obtener los tipos de actas para el select
        $tipos = TipoActa::all();

        return view('livewire.personal.selfactas', [
            'actas' => $actas,
            'tipos' => $tipos,
        ]);
    }
}
