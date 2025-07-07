<?php
namespace App\Livewire\Actas\ActaMatrimonio;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\ActaMatrimonio;
use App\Models\Persona;
use Illuminate\Support\Facades\DB;
use App\Rules\FolioUnico;

class Create extends Component
{
    public $libro_id;
    public $folio_id;
    public $acta_id;
    public $fecha_registro;
    public $novio_id;
    public $novia_id;
    public $fecha_matrimonio;
    public $testigo1_id;
    public $testigo2_id;
    public $mostrarAlerta = false;
    public $personas;
    public $ruta_pdf;
    public $nombreNovio = '';
    public $nombreNovia = '';
    public $nombreTestigo1 = '';
    public $nombreTestigo2 = '';
    public $personasSolteras;
    public $personasSolterasNovio;
    public $personasSolterasNovia;

    public function mount()
    {
        $this->personas = \App\Models\Persona::all();
        $this->personasSolteras = \App\Models\Persona::where('estado_civil', 'S')->get();
        $this->personasSolterasNovio = \App\Models\Persona::where('estado_civil', 'S')->where('sexo', 'M')->get();
        $this->personasSolterasNovia = \App\Models\Persona::where('estado_civil', 'S')->where('sexo', 'F')->get();
    }

    public function placeholder(){
        return view('placeholder');
    }

    public function render()
    {
        return view('livewire.actas.acta-matrimonio.create');
    }

    public function registrarActaMatrimonio()
    {
        $this->validate([
            'acta_id' => 'required|integer|min:1|unique:actas,id',
            'libro_id' => 'required|integer',
            'folio_id' => ['required',new FolioUnico($this->libro_id)],
            'fecha_registro' => 'required|date',
            'ruta_pdf' => 'required|string|max:255',
            'novio_id' => 'required|exists:personas,id',
            'novia_id' => 'required|exists:personas,id',
            'fecha_matrimonio' => 'required|date',
            'testigo1_id' => 'required|exists:personas,id',
            'testigo2_id' => 'required|exists:personas,id',
        ], [
            'acta_id.required' => 'El campo Acta es obligatorio.',
            'acta_id.unique' => 'El ID del acta ya existe. Por favor, use un ID único.',
            'libro_id.required' => 'El campo Libro es obligatorio.',
            'folio_id.required' => 'El campo Folio es obligatorio.',
            'fecha_registro.required' => 'La fecha de registro es obligatoria.',
            'ruta_pdf.required' => 'La ruta del PDF es obligatoria.',
            'novio_id.required' => 'El campo del Novio es obligatorio.',
            'novia_id.required' => 'El campo de la Novia es obligatorio.',
            'fecha_matrimonio.required' => 'La fecha del matrimonio es obligatoria.',
            'testigo1_id.required' => 'El campo del primer testigo es obligatorio.',
            'testigo2_id.required' => 'El campo del segundo testigo es obligatorio.',
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

        // Los testigos no pueden ser la misma persona
        if ($this->testigo1_id == $this->testigo2_id) {
            $this->addError('testigo2_id', 'Los testigos no pueden ser la misma persona.');
            return;
        }

        //Validando la edad minima y que no este declarado como fallecido
        $personasAValidar = [
            'novio_id' => $this->novio_id,
            'novia_id' => $this->novia_id,
            'testigo1_id' => $this->testigo1_id,
            'testigo2_id' => $this->testigo2_id,
        ];

        foreach ($personasAValidar as $campo => $persona_id) {
            $persona = \App\Models\Persona::find($persona_id);

            if (!$persona) {
                $this->addError($campo, 'La persona seleccionada no existe.');
                return;
            }

            // Verificar edad mínima
            $edad = \Carbon\Carbon::parse($persona->fecha_nacimiento)->age;
            if ($edad < 18) {
                $this->addError($campo, 'Debe tener al menos 18 años para registrar el matrimonio.');
                return;
            }

            // Verificar si está registrado como fallecido
            $estaFallecido = \App\Models\ActaDefuncion::where('fallecido_id', $persona_id)->exists();
            if ($estaFallecido) {
                $this->addError($campo, 'La persona seleccionada está registrada como fallecida.');
                return;
            }
        }

        // Buscar el alcalde (rol 3)
        $alcaldeUser = \Spatie\Permission\Models\Role::find(3)?->users->first();
        $alcalde = $alcaldeUser ? \App\Models\Persona::find($alcaldeUser->persona_id) : null;

        if (!$alcalde) {
            $this->addError('persona_id', 'No se encontró un alcalde asignado en el sistema.');
            return;
        }

        // 🔽 CREAR LIBRO si no existe (después de validar)
        if (!\App\Models\Libro::find($this->libro_id)) {
            $libro = new \App\Models\Libro();
            $libro->id = $this->libro_id;
            $libro->save();
        }

        // 🔽 CREAR FOLIO si no existe (después de validar)
        if (!\App\Models\Folio::where('id', $this->folio_id)->where('libro_id', $this->libro_id)->exists()) {
            $folio = new \App\Models\Folio();
            $folio->id = $this->folio_id;
            $folio->libro_id = $this->libro_id;
            $folio->save();
        }

        // 3. Crear Acta (siempre nueva)
        $actaId = "{$this->libro_id}-{$this->folio_id}-{$this->acta_id}";
        $acta = new \App\Models\Acta();
        $acta->id = $actaId;
        $acta->identificador = $this->acta_id;
        $acta->tipo_id = 2;
        $acta->fecha_registro = $this->fecha_registro;
        $acta->persona_id = $alcalde->id;
        $acta->folio_id = $this->folio_id;
        $acta->user_id = Auth::id();
        $acta->ruta_pdf = $this->ruta_pdf;
        $acta->save();

        // 4. Crear Acta Matrimonio (siempre nueva)
        \App\Models\ActaMatrimonio::create([
            'acta_id' => $acta->id,
            'novio_id' => $this->novio_id,
            'novia_id' => $this->novia_id,
            'fecha_matrimonio' => $this->fecha_matrimonio,
            'testigo1_id' => $this->testigo1_id,
            'testigo2_id' => $this->testigo2_id,
        ]);

        $novio = \App\Models\Persona::find($this->novio_id);
        $novia = \App\Models\Persona::find($this->novia_id);

        if ($novio) {
            $novio->estado_civil = 'C';
            $novio->save();
        }
        if ($novia) {
            $novia->estado_civil = 'C';
            $novia->save();
        }

        $this->mostrarAlerta = true;
        $this->reset([
            'libro_id', 'folio_id', 'acta_id', 'novio_id', 'novia_id',
            'fecha_registro', 'fecha_matrimonio', 'testigo1_id', 'testigo2_id',
            'ruta_pdf',
            'nombreNovio', 'nombreNovia', 'nombreTestigo1', 'nombreTestigo2'
        ]);
        session()->flash('message', 'Acta de Matrimonio registrada correctamente.');
        $this->redirect(route('actas-matrimonio', $this->acta_id));
    }
}
