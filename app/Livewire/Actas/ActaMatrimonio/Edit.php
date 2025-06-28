<?php

namespace App\Livewire\Actas\ActaMatrimonio;

use Livewire\Component;
use App\Models\ActaMatrimonio;
use App\Models\Persona;
use App\Models\Acta;

class Edit extends Component
{
    public $libro_id;
    public $folio_id;
    public $acta_id;
    public $fecha_registro;
    public $ruta_pdf;
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
        $acta = Acta::find($this->id_acta);
        $this->libro_id = $acta->folio->libro_id;
        $this->folio_id = $acta->folio_id;
        $this->fecha_registro = $acta->fecha_registro;
        $this->ruta_pdf = $acta->ruta_pdf;
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
            'acta_id' => 'required|integer|min:1|exists:actas,id',
            'libro_id' => 'required|integer',
            'folio_id' => 'required|integer|exists:folios,id',
            'fecha_registro' => 'required|date',
            'ruta_pdf' => 'required|string|max:255',
            'novio_id' => 'required|exists:personas,id',
            'novia_id' => 'required|exists:personas,id',
            'fecha_matrimonio' => 'required|date',
            'testigo1_id' => 'required|exists:personas,id',
            'testigo2_id' => 'required|exists:personas,id',
        ],[
            'acta_id.required' => 'El campo Acta es obligatorio.',
            'libro_id.required' => 'El campo Libro es obligatorio.',
            'folio_id.required' => 'El campo Folio es obligatorio.',
            'fecha_registro.required' => 'La fecha de registro es obligatoria.',
            'ruta_pdf.required' => 'La ruta del PDF es obligatoria.',
            'novio_id.required' => 'El campo Novio es obligatorio.',
            'novia_id.required' => 'El campo Novia es obligatorio.',
            'fecha_matrimonio.required' => 'La fecha de matrimonio es obligatoria.',
            'testigo1_id.required' => 'El campo Testigo 1 es obligatorio.',
            'testigo2_id.required' => 'El campo Testigo 2 es obligatorio.',
            'exists' => 'La persona seleccionada no existe en la base de datos.',
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

        if ($this->novio_id == $this->novia_id) {
            $this->addError('novia_id', 'El novio y la novia no pueden ser la misma persona.');
            return;
        }

        if (
            $this->novio_id == $this->testigo1_id ||
            $this->novio_id == $this->testigo2_id ||
            $this->novia_id == $this->testigo1_id ||
            $this->novia_id == $this->testigo2_id
        ) {
            $this->addError('testigo1_id', 'Ningún novio o novia puede ser testigo.');
            $this->addError('testigo2_id', 'Ningún novio o novia puede ser testigo.');
            return;
        }

        if ($this->testigo1_id == $this->testigo2_id) {
            $this->addError('testigo2_id', 'Los testigos no pueden ser la misma persona.');
            return;
        }

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

        session()->flash('message', 'Acta de Matrimonio actualizada correctamente.');
        $this->redirect(route('actas-matrimonio', $this->acta_id));
    }
}