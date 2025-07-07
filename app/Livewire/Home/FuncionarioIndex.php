<?php

namespace App\Livewire\Home;

use Livewire\Component;
use App\Models\Persona;
use App\Models\ActaDefuncion;
use App\Models\ActaMatrimonio;
use App\Models\ActaNacimiento;
use App\Models\Solicitud;


class FuncionarioIndex extends Component
{
    public $personas;
    public $defunciones;
    public $matrimonios;
    public $nacimientos;
    public $solicitudes; 

    public function mount()
    {
        $this->personas = Persona::count();
        $this->defunciones = ActaDefuncion::whereHas('acta', fn($q) => $q->where('estado', 1))->count();
        $this->matrimonios = ActaMatrimonio::whereHas('acta', fn($q) => $q->where('estado', 1))->count();
        $this->nacimientos = ActaNacimiento::whereHas('acta', fn($q) => $q->where('estado', 1))->count();
        $this->solicitudes = Solicitud::where('funcionario_id', auth()->user()->id)->count();
    }

    public function render()
    {
        return view('livewire.home.funcionario-index');
    }
}
