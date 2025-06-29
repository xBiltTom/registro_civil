<?php

namespace App\Livewire\Actas\ActaNacimiento;

use Livewire\Component;
use App\Models\ActaNacimiento;
use App\Models\Acta;
use Livewire\WithPagination;

class ListarNacimiento extends Component
{
    use WithPagination;
    protected $paginationTheme = 'tailwind';

    public function reiniciar(){
        $this->resetPage();
    }

    public function placeholder(){
        return view('placeholder');
    }


    public function render()
    {
        $nacimientos = ActaNacimiento::paginate(10);

        return view('livewire.actas.acta-nacimiento.listar-nacimiento', [
            'nacimientos' => $nacimientos
        ]);
    }
    public function eliminar($id)
    {
        $nacimiento = ActaNacimiento::find($id);

        if ($nacimiento) {
            $acta = Acta::find($nacimiento->acta_id);

            if ($acta) {
                $acta->delete();
            }

            $nacimiento->delete();

            session()->flash('message', 'Nacimiento eliminado correctamente.');
        } else {
            session()->flash('error', 'Nacimiento no encontrado.');
        }

        $this->reiniciar();
    }
}
