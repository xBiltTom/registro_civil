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

    public function placeholder(){
        return view('placeholder');
    }

    public function render()
    {
        // Usa paginate() en lugar de all()
        $personas = Persona::paginate(8); // 10 items por página

        return view('livewire.personas.listar-personas', [
            'personas' => $personas
        ]);
    }
}
