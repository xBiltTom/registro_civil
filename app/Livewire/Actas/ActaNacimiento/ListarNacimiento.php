<?php

namespace App\Livewire\Actas\ActaNacimiento;

use Livewire\Component;
use App\Models\ActaNacimiento;
use App\Models\Acta;
use Livewire\WithPagination;

class ListarNacimiento extends Component
{
    use WithPagination;
    protected $paginationTheme = 'tailwind'; // o 'tailwind' según tu CSS

    public function reiniciar(){
        $this->resetPage();
    }

    public function placeholder(){
        return view('placeholder');
    }


    public function render()
    {
        // Usa paginate() en lugar de all()
        $nacimientos = ActaNacimiento::paginate(10); // 10 items por página

        return view('livewire.actas.acta-nacimiento.listar-nacimiento', [
            'nacimientos' => $nacimientos
        ]);
    }
    public function eliminar($id)
    {
        // Encuentra el registro de ActaNacimiento por su ID
        $nacimiento = ActaNacimiento::find($id);

        if ($nacimiento) {
            // Encuentra el registro relacionado en la tabla Acta
            $acta = Acta::find($nacimiento->acta_id);

            // Elimina el registro relacionado en la tabla Acta, si existe
            if ($acta) {
                $acta->delete();
            }

            // Finalmente, elimina el registro de ActaNacimiento
            $nacimiento->delete();

            // Mensaje de éxito
            session()->flash('message', 'Nacimiento eliminado correctamente.');
        } else {
            // Mensaje de error si no se encuentra el registro
            session()->flash('error', 'Nacimiento no encontrado.');
        }

        // Reinicia la paginación
        $this->reiniciar();
    }
}
