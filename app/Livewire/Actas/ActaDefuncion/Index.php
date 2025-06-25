<?php

namespace App\Livewire\Actas\ActaDefuncion;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\ActaDefuncion;
use App\Models\Acta;
class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'tailwind';

    public $buscado;

    public function reiniciar(){
        $this->resetPage();
    }

    public function placeholder(){
        return view('placeholder');
    }

    public function render()
    {
        /* $personas = Persona::where(function ($query) {
            if ($this->buscado) {
            $query->where('dni', 'like', '%' . $this->buscado . '%')
                  ->orWhere('nombre', 'like', '%' . $this->buscado . '%')
                  ->orWhere('apellido', 'like', '%' . $this->buscado . '%');
            }
        })->paginate(7); */

        $actas = ActaDefuncion::with(['fallecido','declarante'])->paginate(7);

        return view('livewire.actas.acta-defuncion.index',[
            'actas' => $actas,
        ]);
    }

    public function eliminar($id){
        $acta = Acta::find($id);
        if ($acta) {
            $acta->delete();
            session()->flash('message', 'Acta eliminada correctamente.');
        } else {
            session()->flash('error', 'Acta no encontrada.');
        }
        $this->reiniciar();
    }
}
