<?php

namespace App\Livewire\Actas\ActaMatrimonio;

use Livewire\Component;
use App\Models\ActaMatrimonio;
use Livewire\WithPagination;

class ListarMatrimonios extends Component
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
        $matrimonios = ActaMatrimonio::with(['novio', 'novia', 'testigo1', 'testigo2', 'acta'])->paginate(10);

        return view('livewire.actas.acta-matrimonio.listar-matrimonios', [
            'matrimonios' => $matrimonios
        ]);
    }

    /*public function borrar($id){
        $per = ActaDefuncion::find($id);
        $per->delete();
    }*/

    public function eliminar($acta_id)
    {
        $matrimonio = ActaMatrimonio::find($acta_id);
        if ($matrimonio) {
            $matrimonio->delete();

            session()->flash('mensaje', 'Acta de matrimonio eliminada correctamente.');
        }else {
            session()->flash('mensaje', 'Acta no encontrada.');
        }
    }

    public function editar(String $acta_id)
    {
        return redirect()->route('acta-matrimonio.editar', $acta_id);
    }
}
