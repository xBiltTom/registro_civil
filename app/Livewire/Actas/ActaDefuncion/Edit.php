<?php

namespace App\Livewire\Actas\ActaDefuncion;

use Livewire\Component;
use Spatie\Permission\Models\Role;
use App\Models\Persona;
use App\Models\Libro;
use App\Models\Folio;
use App\Models\Acta;
use App\Models\ActaDefuncion;
use Livewire\WithPagination;
use App\Rules\FolioUnico;

class Edit extends Component
{
    use WithPagination;

    public $id_acta;
    public $id_folio;
    public $id_libro;
    public $id_declarante;
    public $id_funcionario;
    public $id_fallecido;

    public $fecha_registro;
    public $fecha_defuncion;

    public $alcalde;

    public $personas;


    public $nombreFallecido;
    public $nombreDeclarante;
    public $detalle;

    public function placeholder(){
        return view('placeholder');
    }

    public function mount($id){
        $this->id_acta = $id;
        $acta = Acta::find($this->id_acta);
        if($acta){
            $this->id_folio = $acta->folio_id;
            $this->id_libro = $acta->folio->libro_id;
            $this->fecha_registro = $acta->fecha_registro;
            $this->id_funcionario = $acta->user_id;
            $this->fecha_defuncion = $acta->actaDefuncion->fecha_defuncion;
            $this->id_declarante = $acta->actaDefuncion->declarante_id;
            $this->id_fallecido = $acta->actaDefuncion->fallecido_id;
            $this->alcalde = Persona::find($acta->persona_id); // Recuperar alcalde desde el acta
            $this->nombreDeclarante = (Persona::find($this->id_declarante)->nombre ?? '') . ' ' . (Persona::find($this->id_declarante)->apellido ?? '');
            $this->nombreFallecido = (Persona::find($this->id_fallecido)->nombre ?? '') . ' ' . (Persona::find($this->id_fallecido)->apellido ?? '');
            $this->detalle = $acta->actaDefuncion->detalle ?? '';
        } else {
            // Si no existe el acta, inicializar valores
            $this->id_folio = null;
            $this->id_libro = null;
            $this->fecha_registro = now();
            $this->id_funcionario = auth()->user()->id; // Asignar el ID del usuario autenticado
        }
        //Recuperar alcalde
        $this->alcalde = Persona::find(Role::find(3)->users->first()->persona_id); //alcalde recuperado
    }

    public function actualizar(){

        $this->alcalde = Persona::find(Role::find(3)->users->first()->persona_id); //alcalde recuperado

        $this->validate([

            'id_libro' => 'required',
            'id_declarante' => 'required',
            'id_fallecido' => 'required',
            'fecha_registro' => 'required|date',
            'fecha_defuncion' => 'required|date|before_or_equal:fecha_registro',
            'detalle' => 'nullable|string|max:255',
        ],[
            'id_libro.required' => 'El campo Libro es obligatorio.',
            'id_declarante.required' => 'El campo Declarante es obligatorio.',
            'id_fallecido.required' => 'El campo Fallecido es obligatorio.',
            'fecha_registro.required' => 'La fecha de registro es obligatoria.',
            'fecha_defuncion.required' => 'La fecha de defunción es obligatoria.',
            'fecha_defuncion.before_or_equal' => 'La fecha de defunción debe ser igual o anterior a la fecha de registro.',
        ]);

        $acta = Acta::find($this->id_acta);
        $acta->actaDefuncion->fallecido_id = $this->id_fallecido;
        $acta->actaDefuncion->declarante_id = $this->id_declarante;
        $acta->actaDefuncion->fecha_defuncion = $this->fecha_defuncion;
        $acta->actaDefuncion->detalle = $this->detalle;
        $acta->actaDefuncion->save();

        session()->flash('message', 'Acta de Defunción actualizada correctamente.');

        $this->redirect(route('mad', $this->id_acta));




        /* dd([
            'message' =>  'Registrar Acta de Defunción',
            'funcionario' => $this->id_funcionario,
            'id_alcalde' => $this->alcalde->id,
            'id_acta' => $this->id_acta,
            'id_folio' => $this->id_folio,
            'id_libro' => $this->id_libro,
            'fecha de registro' => $this->fecha_registro,
            'fecha de defunción' => $this->fecha_defuncion,
            'declarante' =>$this->id_declarante,
            'fallecido' =>$this->id_fallecido,
            'detalle' => $this->detalle,
        ]); */
    }

    public function render(){
        $this->personas = Persona::all();
        return view('livewire.actas.acta-defuncion.edit',[
            'personas' => $this->personas,
        ]);
    }
}
