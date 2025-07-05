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

class Edit extends Component
{

    public function placeholder(){
        return view('placeholder');
    }
    public $acta_id;
    public $identificador;
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

    public $nombreMadre;
    public $nombrePadre;

    public function mount($id)
{
    $acta = Acta::findOrFail($id);
    $actaNacimiento = $acta->actaNacimiento;
    $personaNacido = $actaNacimiento->nacido; // Usar la relación nacido

    $this->acta_id = $acta->id;
    $this->identificador = $acta->identificador;
    $this->folio_id = $acta->folio_id;
    $this->libro_id = $acta->folio->libro_id;
    $this->fecha_registro = $acta->fecha_registro;

    $this->dni = $personaNacido->dni;
    $this->nombre_nacido = $personaNacido->nombre;
    $this->apellido_nacido = $personaNacido->apellido;
    $this->sexo = $personaNacido->sexo;
    $this->fecha_nacimiento = $personaNacido->fecha_nacimiento;
    $this->lugar_id = $personaNacido->lugar_id;

    $this->madre_id = $actaNacimiento->madre_id;
    $this->padre_id = $actaNacimiento->padre_id;

    $this->nombreMadre = $actaNacimiento->madre ?
        $actaNacimiento->madre->nombre . ' ' . $actaNacimiento->madre->apellido : '';
    $this->nombrePadre = $actaNacimiento->padre ?
        $actaNacimiento->padre->nombre . ' ' . $actaNacimiento->padre->apellido : '';

    $this->personas = Persona::whereDate('fecha_nacimiento', '<=', now()->subYears(16))->get();
    $this->lugares = Lugar::all();
}

public function actualizarNacimiento()
{
    Log::info('Iniciando la actualización del acta de nacimiento.');

    $this->validate([
        'folio_id' => 'required|integer',
        'libro_id' => 'required|integer',
        'fecha_registro' => 'required|date',
        'nombre_nacido' => 'required|string|max:255',
        'sexo' => 'required|in:M,F',
        'fecha_nacimiento' => 'required|date|before_or_equal:fecha_registro',
        'lugar_id' => 'required|exists:lugar,id',
        'madre_id' => [
            'required',
            'exists:personas,id',
            function ($attribute, $value, $fail) {
                $madreFallecida = \App\Models\ActaDefuncion::where('fallecido_id', $value)->exists();
                if ($madreFallecida) {
                    $fail('La madre no puede ser una persona fallecida.');
                }
            },
        ],
        'padre_id' => [
            'nullable',
            'exists:personas,id',
            function ($attribute, $value, $fail) {
                $padreFallecido = \App\Models\ActaDefuncion::where('fallecido_id', $value)->exists();
                if ($padreFallecido) {
                    $fail('El padre no puede ser una persona fallecida.');
                }
            },
            function ($attribute, $value, $fail) {
                if ($value === $this->madre_id) {
                    $fail('Una persona no puede ser padre y madre al mismo tiempo.');
                }
            },
        ],
    ], [
        'folio_id.required' => 'El campo Folio es obligatorio.',
        'libro_id.required' => 'El campo Libro es obligatorio.',
        'fecha_registro.required' => 'La fecha de registro es obligatoria.',
        'nombre_nacido.required' => 'El nombre del nacido es obligatorio.',
        'sexo.required' => 'El campo Sexo es obligatorio.',
        'fecha_nacimiento.required' => 'La fecha de nacimiento es obligatoria.',
        'fecha_nacimiento.before_or_equal' => 'La fecha de nacimiento debe ser igual o anterior a la fecha de registro.',
        'lugar_id.required' => 'El lugar de nacimiento es obligatorio.',
        'madre_id.required' => 'El campo Madre es obligatorio.',
        'madre_id.exists' => 'La madre seleccionada no existe.',
        'padre_id.exists' => 'El padre seleccionado no existe.',
    ]);

    Log::info('Validación completada.');

    DB::transaction(function () {
        $acta = Acta::findOrFail($this->acta_id);
        $actaNacimiento = $acta->actaNacimiento;
        $personaNacido = $actaNacimiento->nacido; // Usar la relación nacido

        $madre = Persona::find($this->madre_id);
        $padre = Persona::find($this->padre_id);

        $apellido_madre = $madre ? explode(' ', $madre->apellido)[0] : '';
        $apellido_padre = $padre ? explode(' ', $padre->apellido)[0] : '';

        $this->apellido_nacido = trim($apellido_padre . ' ' . $apellido_madre);

        if ($acta->folio->libro_id != $this->libro_id) {
            $libro = Libro::firstOrCreate(['id' => $this->libro_id]);

            $folio = Folio::firstOrCreate(
                ['id' => $this->folio_id],
                ['libro_id' => $this->libro_id]
            );

            $acta->folio_id = $folio->id;
        }

        $personaNacido->update([
            'dni' => $this->dni,
            'nombre' => $this->nombre_nacido,
            'apellido' => $this->apellido_nacido,
            'sexo' => $this->sexo,
            'fecha_nacimiento' => $this->fecha_nacimiento,
            'lugar_id' => $this->lugar_id,
        ]);

        $acta->update([
            'fecha_registro' => $this->fecha_registro,
            'folio_id' => $this->folio_id,
            'user_id' => Auth::id(),
        ]);

        $actaNacimiento->update([
            'madre_id' => $this->madre_id,
            'padre_id' => $this->padre_id,
            'lugar_id' => $this->lugar_id,
        ]);

        Log::info('Acta de nacimiento actualizada correctamente.');
    });

    session()->flash('message', 'Acta de nacimiento actualizada exitosamente');

    return redirect()->route('actas-nacimiento', $this->acta_id);
}

    public function render()
    {
        return view('livewire.actas.acta-nacimiento.edit', [
            'personas' => $this->personas,
            'lugares' => $this->lugares,
        ]);
    }
}
