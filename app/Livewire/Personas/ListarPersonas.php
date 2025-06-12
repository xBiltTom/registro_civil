<?php

namespace App\Livewire\Personas;

use Livewire\Component;
use App\Models\Persona;
use Livewire\WithPagination;

class ListarPersonas extends Component
{
    use WithPagination;

    // Elimina esta propiedad ya que no la necesitarás
    // public $personas;

    // Opcional: puedes personalizar el tema de paginación
    protected $paginationTheme = 'tailwind'; // o 'tailwind' según tu CSS

    public $buscado;

    public function placeholder(){
        return view('placeholder');
    }

    public function reiniciar(){
        $this->resetPage();
    }

    public function render()
    {
        // Usa paginate() en lugar de all()
       /*  $personas = Persona::paginate(7); // 10 items por página */

        $personas = Persona::where(function ($query) {
            if ($this->buscado) {
            $query->where('dni', 'like', '%' . $this->buscado . '%')
                  ->orWhere('nombre', 'like', '%' . $this->buscado . '%')
                  ->orWhere('apellido', 'like', '%' . $this->buscado . '%');
            }
        })->paginate(5);

        return view('livewire.personas.listar-personas', [
            'personas' => $personas
        ]);
    }

    public function borrar($id){
        $per = Persona::find($id);
        $per->delete();
    }
}
