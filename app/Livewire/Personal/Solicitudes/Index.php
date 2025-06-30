<?php
namespace App\Livewire\Personal\Solicitudes;

use App\Models\Solicitud;
use App\Models\TipoActa;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Acta;

class Index extends Component
{
    use WithPagination;

    protected $paginationTheme = 'tailwind';

    public $buscado; // Para la búsqueda
    public $tipoSeleccionado = 'all'; // Valor por defecto para el filtro de tipos
    public $tipos;

    public function mount()
    {
        $this->tipos = TipoActa::all();
    }

    public function reiniciar()
    {
        $this->resetPage();
    }

    public function render()
    {
        $usuario = auth()->user();

        $query = Solicitud::with(['acta.tipo'])
            ->where('user_id', $usuario->id);

        if ($this->tipoSeleccionado !== 'all') {
            $query->whereHas('acta', function ($query) {
                $query->where('tipo_id', $this->tipoSeleccionado);
            });
        }

        if ($this->buscado) {
            $query->where('acta_id', 'like', '%' . $this->buscado . '%');
        }

        $solicitudes = $query->paginate(10);

        return view('livewire.personal.solicitudes.index', [
            'solicitudes' => $solicitudes,
            'tipos' => $this->tipos,
        ]);
    }
}
