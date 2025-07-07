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
        $matrimonios = ActaMatrimonio::whereHas('acta', function ($query) {
                $query->where('estado', 1);
            })
            ->with(['novio', 'novia', 'testigo1', 'testigo2', 'acta'])
            ->orderBy('acta_id', 'desc')
            ->paginate(10);

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
        $matrimonio = \App\Models\ActaMatrimonio::find($acta_id);
            if ($matrimonio) {
                $acta = $matrimonio->acta;

            // 1. Cambiar estado civil de los novios a 'S'
            if ($matrimonio->novio) {
                $matrimonio->novio->estado_civil = 'S';
                $matrimonio->novio->save();
            }

            if ($matrimonio->novia) {
                $matrimonio->novia->estado_civil = 'S';
                $matrimonio->novia->save();
            }

            // 2. Cambiar estado del acta a 0 (marcar como "eliminada")
            if ($acta) {
                $acta->estado = 0;
                $acta->save();
            }
            session()->flash('mensaje', 'Acta de matrimonio eliminada correctamente.');
        }
    }

    public function editar(String $acta_id)
    {
        return redirect()->route('acta-matrimonio.editar', $acta_id);
    }
}
