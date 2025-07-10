<?php
namespace App\Livewire\Personal\Solicitudes;

use App\Models\Solicitud;
use App\Models\EstadoSolicitud;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Log;

class Index extends Component
{
    use WithPagination;

    protected $paginationTheme = 'tailwind';

    public $buscado; // Para la búsqueda por número de acta
    public $estadoSeleccionado = 'all'; // Valor por defecto para el filtro de estado
    public $estados; // Lista de estados de solicitudes

    public function mount()
    {
        // Cargar los estados de las solicitudes desde la base de datos
        $this->estados = EstadoSolicitud::all();
    }

    public function reiniciar()
    {
        $this->resetPage();
    }

    public function placeholder(){
        return view('placeholder');
    }

    public function updatedEstadoSeleccionado()
    {
        $this->resetPage();
    }

    public function updatedBuscado()
    {
        $this->resetPage();
    }

    public function render()
    {
        $usuario = auth()->user();

        // Consulta base para obtener las solicitudes del usuario autenticado
        $query = Solicitud::with(['acta.tipo', 'estado'])
            ->where('user_id', $usuario->id);

        // Filtrar por estado seleccionado
        if ($this->estadoSeleccionado !== 'all') {
            $query->where('estado_id', $this->estadoSeleccionado);
        }

        // Aplicar búsqueda por número de acta
        if ($this->buscado) {
            $query->where('acta_id', 'like', '%' . $this->buscado . '%');
        }

        // Paginación de los resultados
        $solicitudes = $query->orderBy('created_at', 'desc')->paginate(5);

        return view('livewire.personal.solicitudes.index', [
            'solicitudes' => $solicitudes,
            'estados' => $this->estados,
        ]);
    }
}
