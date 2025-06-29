<?php

namespace App\Livewire\Actas\ActaNacimiento;

use Livewire\Component;
use App\Models\ActaNacimiento;
use App\Models\Persona;
use App\Models\Acta;
use App\Models\Folio;
use App\Models\Libro;
use App\Models\Lugar;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class Create extends Component
{

    public function placeholder(){
        return view('placeholder');
    }
    public $acta_id;
    public $folio_id;
    public $libro_id;
    public $fecha_registro;

    public $dni;
    public $nombre_nacido;
    public $apellido_nacido;
    public $sexo;
    public $fecha_nacimiento;
    public $lugar_id;

    public $madre_id;
    public $padre_id;

    public $personas;
    public $lugares;

    public function mount()
    {
        $this->personas = Persona::all();
        $this->lugares = Lugar::all();
    }

    public function guardarNacimiento()
{
    Log::info('Iniciando el registro del acta de nacimiento.');

    $this->validate([
        'acta_id' => 'required|integer|unique:actas,id',
        'folio_id' => 'required|integer',
        'libro_id' => 'required|integer',
        'fecha_registro' => 'required|date',
        'nombre_nacido' => 'required|string|max:255',
        'sexo' => 'required|in:M,F',
        'fecha_nacimiento' => 'required|date',
        'lugar_id' => 'required|exists:lugar,id',
        'madre_id' => [
            'required',
            'exists:personas,id',
            function ($attribute, $value, $fail) {
                $madre = Persona::find($value);
                if ($madre && $madre->sexo !== 'F') {
                    $fail('La madre debe ser de sexo femenino.');
                }
            },
        ],
        'padre_id' => [
            'nullable',
            'exists:personas,id',
            function ($attribute, $value, $fail) {
                $padre = Persona::find($value);
                if ($padre && $padre->sexo !== 'M') {
                    $fail('El padre debe ser de sexo masculino.');
                }
            },
            function ($attribute, $value, $fail) {
                if ($value === $this->madre_id) {
                    $fail('Una persona no puede ser padre y madre al mismo tiempo.');
                }
            },
        ],
        ], [
            'acta_id.required' => 'El campo Acta es obligatorio.',
            'acta_id.unique' => 'El Acta ya existe.',
            'folio_id.required' => 'El campo Folio es obligatorio.',
            'libro_id.required' => 'El campo Libro es obligatorio.',
            'fecha_registro.required' => 'La fecha de registro es obligatoria.',
            'nombre_nacido.required' => 'El nombre del nacido es obligatorio.',
            'sexo.required' => 'El campo Sexo es obligatorio.',
            'fecha_nacimiento.required' => 'La fecha de nacimiento es obligatoria.',
            'lugar_id.required' => 'El lugar de nacimiento es obligatorio.',
            'madre_id.required' => 'El campo Madre es obligatorio.',
            'madre_id.exists' => 'La madre seleccionada no existe.',
            'padre_id.exists' => 'El padre seleccionado no existe.',
        ]);

        Log::info('Validación completada.');

        $madre = Persona::find($this->madre_id);
        $padre = Persona::find($this->padre_id);

        $apellido_madre = $madre ? explode(' ', $madre->apellido)[0] : '';
        $apellido_padre = $padre ? explode(' ', $padre->apellido)[0] : '';

        $this->apellido_nacido = trim($apellido_padre . ' ' . $apellido_madre);

        if (Libro::find($this->libro_id) == null) {
            $libro = new Libro();
            $libro->id = $this->libro_id;
            $libro->save();
        }

        if (Folio::find($this->folio_id) == null) {
            $folio = new Folio();
            $folio->id = $this->folio_id;
            $folio->libro_id = $this->libro_id;
            $folio->save();
        }

        Log::info('Libro y folio creados correctamente.');

        $personaNacido = Persona::create([
            'dni' => $this->dni,
            'nombre' => $this->nombre_nacido,
            'apellido' => $this->apellido_nacido,
            'sexo' => $this->sexo,
            'fecha_nacimiento' => $this->fecha_nacimiento,
            'lugar_id' => $this->lugar_id,
        ]);

        Log::info('Persona nacida creada correctamente.');

        $acta = Acta::create([
            'id' => $this->acta_id,
            'fecha_registro' => $this->fecha_registro,
            'persona_id' => $personaNacido->id,
            'folio_id' => $this->folio_id,
            'user_id' => optional(Auth::user())->id,
            'tipo_id' => 1,
        ]);

        Log::info('Acta creada correctamente.');

        $actaNacimiento = ActaNacimiento::create([
            'nombre_nacido' => $this->nombre_nacido,
            'apellido_nacido' => $this->apellido_nacido,
            'sexo' => $this->sexo,
            'fecha_nacimiento' => $this->fecha_nacimiento,
            'madre_id' => $this->madre_id,
            'padre_id' => $this->padre_id,
            'acta_id' => $this->acta_id,
            'lugar_id' => $this->lugar_id,
        ]);

        Log::info('Acta de nacimiento creada correctamente.');

        $this->reset(['acta_id', 'folio_id', 'libro_id', 'fecha_registro', 'dni', 'nombre_nacido', 'apellido_nacido', 'sexo', 'fecha_nacimiento', 'lugar_id', 'madre_id', 'padre_id']);
        session()->flash('message', 'Acta de nacimiento registrada exitosamente');

        $this->redirect(route('actas-nacimiento', $this->acta_id));
    }

    public function render()
    {
        return view('livewire.actas.acta-nacimiento.create', [
            'personas' => $this->personas,
            'lugares' => $this->lugares,
        ]);
    }
}
