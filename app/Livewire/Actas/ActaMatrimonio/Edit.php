<?php

namespace App\Livewire\Actas\ActaMatrimonio;

use Livewire\Component;
use App\Models\ActaMatrimonio;
use App\Models\Persona;

class Edit extends Component
{
    public $actaMatrimonio;
    public $novio_id, $novia_id, $fecha_matrimonio, $testigo1_id, $testigo2_id;
    public $personas;
    public $personasSolterasNovio;
    public $personasSolterasNovia;

    // Propiedades para mostrar los nombres en los inputs de los modales
    public $nombreNovio = '';
    public $nombreNovia = '';
    public $nombreTestigo1 = '';
    public $nombreTestigo2 = '';
    public $id_acta;


    public function mount($acta_id)
    {
        $this->id_acta = $acta_id; // <--- Agrega esta línea
        $this->actaMatrimonio = ActaMatrimonio::findOrFail($acta_id);
        $this->novio_id = $this->actaMatrimonio->novio_id;
        $this->novia_id = $this->actaMatrimonio->novia_id;
        $this->fecha_matrimonio = $this->actaMatrimonio->fecha_matrimonio;
        $this->testigo1_id = $this->actaMatrimonio->testigo1_id;
        $this->testigo2_id = $this->actaMatrimonio->testigo2_id;
        $this->personas = Persona::all();

        // Solo solteros y sexo correspondiente para los modales de novios
        $this->personasSolterasNovio = Persona::where('estado_civil', 'S')->where('sexo', 'M')->get();
        $this->personasSolterasNovia = Persona::where('estado_civil', 'S')->where('sexo', 'F')->get();

        // Inicializa los nombres para los inputs de los modales
        $novio = Persona::find($this->novio_id);
        $novia = Persona::find($this->novia_id);
        $testigo1 = Persona::find($this->testigo1_id);
        $testigo2 = Persona::find($this->testigo2_id);

        $this->nombreNovio = $novio ? $novio->nombre . ' ' . $novio->apellido : '';
        $this->nombreNovia = $novia ? $novia->nombre . ' ' . $novia->apellido : '';
        $this->nombreTestigo1 = $testigo1 ? $testigo1->nombre . ' ' . $testigo1->apellido : '';
        $this->nombreTestigo2 = $testigo2 ? $testigo2->nombre . ' ' . $testigo2->apellido : '';
    }

    public function actualizar()
    {
        $this->validate([
            'novio_id' => 'required|exists:personas,id',
            'novia_id' => 'required|exists:personas,id',
            'fecha_matrimonio' => 'required|date',
            'testigo1_id' => 'required|exists:personas,id',
            'testigo2_id' => 'required|exists:personas,id',
        ]);

        // Guardar los IDs anteriores
        $novioAnteriorId = $this->actaMatrimonio->novio_id;
        $noviaAnteriorId = $this->actaMatrimonio->novia_id;

        // Actualizar el acta de matrimonio
        $this->actaMatrimonio->update([
            'novio_id' => $this->novio_id,
            'novia_id' => $this->novia_id,
            'fecha_matrimonio' => $this->fecha_matrimonio,
            'testigo1_id' => $this->testigo1_id,
            'testigo2_id' => $this->testigo2_id,
        ]);

        // Si cambió el novio, poner el anterior como soltero
        if ($novioAnteriorId != $this->novio_id) {
            $novioAnterior = \App\Models\Persona::find($novioAnteriorId);
            if ($novioAnterior) {
                $novioAnterior->estado_civil = 'S';
                $novioAnterior->save();
            }
        }
        // Si cambió la novia, poner la anterior como soltera
        if ($noviaAnteriorId != $this->novia_id) {
            $noviaAnterior = \App\Models\Persona::find($noviaAnteriorId);
            if ($noviaAnterior) {
                $noviaAnterior->estado_civil = 'S';
                $noviaAnterior->save();
            }
        }

        // Los nuevos novios quedan como casados
        $novioNuevo = \App\Models\Persona::find($this->novio_id);
        if ($novioNuevo) {
            $novioNuevo->estado_civil = 'C';
            $novioNuevo->save();
        }
        $noviaNuevo = \App\Models\Persona::find($this->novia_id);
        if ($noviaNuevo) {
            $noviaNuevo->estado_civil = 'C';
            $noviaNuevo->save();
        }

        // Actualiza los nombres por si cambió alguno
        $novio = \App\Models\Persona::find($this->novio_id);
        $novia = \App\Models\Persona::find($this->novia_id);
        $testigo1 = \App\Models\Persona::find($this->testigo1_id);
        $testigo2 = \App\Models\Persona::find($this->testigo2_id);

        $this->nombreNovio = $novio ? $novio->nombre . ' ' . $novio->apellido : '';
        $this->nombreNovia = $novia ? $novia->nombre . ' ' . $novia->apellido : '';
        $this->nombreTestigo1 = $testigo1 ? $testigo1->nombre . ' ' . $testigo1->apellido : '';
        $this->nombreTestigo2 = $testigo2 ? $testigo2->nombre . ' ' . $testigo2->apellido : '';

        session()->flash('mensaje', 'Acta de matrimonio actualizada correctamente.');
    }
}