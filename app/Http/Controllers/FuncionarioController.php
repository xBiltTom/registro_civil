<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Acta;
use App\Models\ActaDefuncion;
use App\Models\Persona;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;

class FuncionarioController extends Controller
{

    public function __construct(){
        $this->authorizeResource(User::class);
        /* $this->authorizeResource(Acta::class);
        $this->authorizeResource(ActaDefuncion::class); */
    }

    public function indexMatrimonios(){
        $this->authorize('viewAny', Acta::class);
        return view('Actas.Matrimonios.index');
    }

    public function indexNacimiento(){
        $this->authorize('viewAny', Acta::class);
        return view('Actas.Nacimientos.index');
    }

    public function registrarActa(){
        $this->authorize('viewAny', Acta::class);
        return view('Actas.Matrimonios.create');
    }

    public function registrarNacimiento(){
        $this->authorize('viewAny', Acta::class);
        return view('Actas.Nacimientos.create');
    }
    public function editNacimiento($id){
        $this->authorize('viewAny', Acta::class);
        return view('Actas.Nacimientos.edit', compact('id'));

    }

    public function pdfNacimiento(String $id)
    {

        $acta = Acta::find($id);

        if (!$acta || !$acta->actaNacimiento) {
            abort(404, 'Acta o acta de nacimiento no encontrada');
        }

        $nacido = Persona::find($acta->persona_id);
        $madre = Persona::find($acta->actaNacimiento->madre_id);
        $padre = Persona::find($acta->actaNacimiento->padre_id);
        $fecha_actual = now();
        $pdf = Pdf::loadView('nacimientosPdf', compact('acta', 'nacido', 'madre', 'padre', 'fecha_actual'));
        return $pdf->stream();
    }

    public function pdf(String $id){
        $acta = Acta::find($id);
        $fallecido = Persona::find($acta->actaDefuncion->fallecido_id);
        $declarante = Persona::find($acta->actaDefuncion->declarante_id);
        $funcionario = User::find($acta->user_id);
        $alcalde = Persona::find($acta->persona_id);
        $fecha_actual = now();
        $pdf = Pdf::loadView('defuncionesPdf',compact('acta','fallecido','declarante','funcionario','alcalde','fecha_actual'));
        return $pdf->stream();
    }

    public function pdfMatrimonio($id){
        /* $this->authorize('viewAny', Acta::class); */
        $acta = Acta::find($id);
        if (!$acta || !$acta->actaMatrimonio) {
            abort(404, 'Acta o acta de matrimonio no encontrada');
        }
        $novio = Persona::find($acta->actaMatrimonio->novio_id);
        $novia = Persona::find($acta->actaMatrimonio->novia_id);
        $testigo1 = Persona::find($acta->actaMatrimonio->testigo1_id);
        $testigo2 = Persona::find($acta->actaMatrimonio->testigo2_id);
        $funcionario = User::find($acta->user_id);
        $alcalde = Persona::find($acta->persona_id);
        $fecha_actual = now();
        $pdf = Pdf::loadView('matrimoniosPdf', compact('acta','novio','novia','testigo1','testigo2','funcionario','alcalde','fecha_actual'));
        return $pdf->stream();
    }

    public function editarActaMatrimonio($id){
        $this->authorize('viewAny', Acta::class);
        return view('Actas.Matrimonios.edit', ['id' => $id]);

    }

    public function mostrarActaDefunciones(){
        $this->authorize('viewAny', Acta::class);
        return view('Actas.defunciones.index');
    }

    public function registrarActaDefunciones(){
        $this->authorize('viewAny', Acta::class);
        return view('Actas.defunciones.create');
    }

    public function editarActaDefunciones(String $id){
        $this->authorize('viewAny', Acta::class);
        return view('Actas.defunciones.edit',compact('id'));
    }

    public function mostrarPagos(){
        $this->authorize('viewAny', Acta::class);
        return view('pagos.index');
    }
}
