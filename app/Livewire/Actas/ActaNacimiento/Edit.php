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
    // Datos del Acta
    public $acta_id;
    public $folio_id;
    public $libro_id;
    public $fecha_registro;

    // Datos del Nacido
    public $dni;
    public $nombre_nacido;
    public $apellido_nacido;
    public $sexo;
    public $fecha_nacimiento;
    public $lugar_id;

    // Datos de los padres
    public $madre_id;
    public $padre_id;

    // Listas de selección
    public $personas;
    public $lugares;

    // Nombres completos para mostrar
    public $nombreMadre;
    public $nombrePadre;

    public function mount($id)
    {
        // Cargar el acta existente
        $acta = Acta::findOrFail($id);
        $actaNacimiento = $acta->actaNacimiento;
        $personaNacido = $acta->persona;

        // Datos del acta
        $this->acta_id = $acta->id;
        $this->folio_id = $acta->folio_id;
        $this->libro_id = $acta->folio->libro_id;
        $this->fecha_registro = $acta->fecha_registro;

        // Datos del nacido
        $this->dni = $personaNacido->dni;
        $this->nombre_nacido = $actaNacimiento->nombre_nacido;
        $this->apellido_nacido = $actaNacimiento->apellido_nacido;
        $this->sexo = $actaNacimiento->sexo;
        $this->fecha_nacimiento = $actaNacimiento->fecha_nacimiento;
        $this->lugar_id = $actaNacimiento->lugar_id;

        // Datos de los padres
        $this->madre_id = $actaNacimiento->madre_id;
        $this->padre_id = $actaNacimiento->padre_id;

        // Nombres completos de los padres
        $this->nombreMadre = $actaNacimiento->madre ?
            $actaNacimiento->madre->nombre . ' ' . $actaNacimiento->madre->apellido : '';
        $this->nombrePadre = $actaNacimiento->padre ?
            $actaNacimiento->padre->nombre . ' ' . $actaNacimiento->padre->apellido : '';

        // Cargar personas y lugares desde la base de datos
        $this->personas = Persona::all();
        $this->lugares = Lugar::all();
    }

    public function actualizarNacimiento()
    {
        Log::info('Iniciando la actualización del acta de nacimiento.');

        // Validar los datos ingresados
        $this->validate([
            'folio_id' => 'required|integer',
            'libro_id' => 'required|integer',
            'fecha_registro' => 'required|date',
            'nombre_nacido' => 'required|string|max:255',
            'apellido_nacido' => 'required|string|max:255',
            'sexo' => 'required|in:M,F',
            'fecha_nacimiento' => 'required|date|before_or_equal:fecha_registro',
            'lugar_id' => 'required|exists:lugar,id',
            'madre_id' => 'required|exists:personas,id',
            'padre_id' => 'nullable|exists:personas,id',
        ], [
            'folio_id.required' => 'El campo Folio es obligatorio.',
            'libro_id.required' => 'El campo Libro es obligatorio.',
            'fecha_registro.required' => 'La fecha de registro es obligatoria.',
            'nombre_nacido.required' => 'El nombre del nacido es obligatorio.',
            'apellido_nacido.required' => 'El apellido del nacido es obligatorio.',
            'sexo.required' => 'El campo Sexo es obligatorio.',
            'fecha_nacimiento.required' => 'La fecha de nacimiento es obligatoria.',
            'fecha_nacimiento.before_or_equal' => 'La fecha de nacimiento debe ser igual o anterior a la fecha de registro.',
            'lugar_id.required' => 'El lugar de nacimiento es obligatorio.',
            'madre_id.required' => 'El campo Madre es obligatorio.',
        ]);

        Log::info('Validación completada.');

        DB::transaction(function () {
            // Obtener el acta y sus relaciones
            $acta = Acta::findOrFail($this->acta_id);
            $actaNacimiento = $acta->actaNacimiento;
            $personaNacido = $acta->persona;

            // Actualizar libro si ha cambiado
            if ($acta->folio->libro_id != $this->libro_id) {
                $libro = Libro::firstOrCreate(['id' => $this->libro_id]);

                // Actualizar folio
                $folio = Folio::firstOrCreate(
                    ['id' => $this->folio_id],
                    ['libro_id' => $this->libro_id]
                );

                $acta->folio_id = $folio->id;
            }

            // Actualizar persona nacida
            $personaNacido->update([
                'dni' => $this->dni,
                'nombre' => $this->nombre_nacido,
                'apellido' => $this->apellido_nacido,
                'sexo' => $this->sexo,
                'fecha_nacimiento' => $this->fecha_nacimiento,
                'lugar_id' => $this->lugar_id,
            ]);

            // Actualizar acta
            $acta->update([
                'fecha_registro' => $this->fecha_registro,
                'folio_id' => $this->folio_id,
                'user_id' => Auth::id(),
            ]);

            // Actualizar acta de nacimiento
            $actaNacimiento->update([
                'nombre_nacido' => $this->nombre_nacido,
                'apellido_nacido' => $this->apellido_nacido,
                'sexo' => $this->sexo,
                'fecha_nacimiento' => $this->fecha_nacimiento,
                'madre_id' => $this->madre_id,
                'padre_id' => $this->padre_id,
                'lugar_id' => $this->lugar_id,
            ]);

            Log::info('Acta de nacimiento actualizada correctamente.');
        });

        // Mensaje de éxito
        session()->flash('message', 'Acta de nacimiento actualizada exitosamente');

        // Redireccionar a la vista de detalle
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
