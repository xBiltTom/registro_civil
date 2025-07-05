<?php

namespace App\Livewire\Actas\ActaDefuncion;

use Livewire\Component;
use Spatie\Permission\Models\Role;
use App\Models\Persona;
use App\Models\Libro;
use App\Models\Folio;
use App\Models\Acta;
use App\Models\User;
use App\Models\ActaDefuncion;
use Livewire\WithPagination;
use App\Rules\FolioUnico;


class Create extends Component
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

    public $funcionarioPersona;


    public $nombreFallecido;
    public $nombreDeclarante;
    public $detalle;

    public function placeholder(){
        return view('placeholder');
    }

    public function registrar(){
        $this->alcalde = Persona::find(Role::find(3)->users->first()->persona_id); //alcalde recuperado
        $this->funcionarioPersona = auth()->user()->persona_id;
        $this->validate([
            'id_acta' => 'required|unique:actas,id',
            'id_folio' => ['required',new FolioUnico()],
            'id_libro' => 'required',
            'id_declarante' => 'required|different:id_fallecido',
            'id_fallecido' => 'required|different:funcionarioPersona',
            'fecha_registro' => 'required|date',
            'fecha_defuncion' => 'required|date|before_or_equal:fecha_registro',
            'detalle' => 'nullable|string|max:255',
        ],[
            'id_acta.required' => 'El campo Acta es obligatorio.',
            'id_acta.unique' => 'El Acta ya existe.',
            'id_folio.required' => 'El campo Folio es obligatorio.',
            'id_libro.required' => 'El campo Libro es obligatorio.',
            'id_declarante.required' => 'El campo Declarante es obligatorio.',
            'id_declarante.different' => 'El declarante no puede ser el mismo que el fallecido.',
            'id_fallecido.required' => 'El campo Fallecido es obligatorio.',
            'id_fallecido.different' => 'El fallecido no puede ser el usuario activo en la sesion.',
            'fecha_registro.required' => 'La fecha de registro es obligatoria.',
            'fecha_defuncion.required' => 'La fecha de defunción es obligatoria.',
            'fecha_defuncion.before_or_equal' => 'La fecha de defunción debe ser igual o anterior a la fecha de registro.',
        ]);

        // Validar si el folio ya está relacionado con un acta


        if(Libro::find($this->id_libro)==null){
            //Libro no existe, crear libro
            $libro = new Libro();
            $libro->id = $this->id_libro;
            $libro->save();
        }

        if(Folio::find($this->id_folio)==null){
            //Folio no existe, crear folio
            $folio = new Folio();
            $folio->id = $this->id_folio;
            $folio->libro_id = $this->id_libro;
            $folio->save();
        }

        $actaId = "{$this->id_libro}-{$this->id_folio}-{$this->id_acta}";

        if(Acta::find($actaId)==null){
        //Acta no existe, crear acta
            $this->id_funcionario = auth()->user()->id;
            $acta = new Acta();
            $acta->id = $actaId;
            $acta->identificador = $this->id_acta;
            $acta->fecha_registro = $this->fecha_registro;
            $acta->persona_id = $this->alcalde->id;
            $acta->folio_id = $this->id_folio;
            $acta->tipo_id=3;
            $acta->user_id = $this->id_funcionario;
            $acta->ruta_pdf=null;
            $acta->save();

            //Crear acta de defuncion
            $acta_defuncion = new ActaDefuncion();
            $acta_defuncion->acta_id = $actaId;
            $acta_defuncion->fallecido_id = $this->id_fallecido;
            $acta_defuncion->fecha_defuncion = $this->fecha_defuncion;
            $acta_defuncion->declarante_id = $this->id_declarante;
            $acta_defuncion->detalle = $this->detalle;
            $acta_defuncion->save();
        }

        $this->reset(['id_acta', 'id_folio', 'id_libro', 'id_declarante', 'id_fallecido', 'fecha_registro', 'fecha_defuncion', 'detalle']);
        session()->flash('message', 'Acta de Defunción registrada correctamente.');

        $this->redirect(route('mad', $this->id_acta));
    }

    public function render(){
        $this->personas = Persona::whereNotIn('id', ActaDefuncion::pluck('fallecido_id'))->get();
        return view('livewire.actas.acta-defuncion.create',[
            'personas' => $this->personas,
        ]);
    }
}
