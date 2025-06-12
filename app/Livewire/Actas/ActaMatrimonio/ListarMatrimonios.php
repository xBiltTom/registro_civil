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
            // Guarda los IDs antes de eliminar el registro de matrimonio
            $actaId = $matrimonio->acta_id ?? null;
            $folioId = $matrimonio->folio_id ?? null;

            // 1. Elimina el acta de matrimonio
            $matrimonio->delete();

            // 2. Elimina el acta asociada
            if ($actaId) {
                $acta = \App\Models\Acta::find($actaId);
                if ($acta) {
                    $acta->delete();
                }
            }

            // 3. Elimina el folio asociado
            if ($folioId) {
                $folio = \App\Models\Folio::find($folioId);
                if ($folio) {
                    $folio->delete();
                }
            }

            session()->flash('mensaje', 'Acta de matrimonio, acta y folio eliminados correctamente.');
        }
    }

    public function editar($acta_id)
    {
        return redirect()->route('acta-matrimonio.editar', $acta_id);
    }
}