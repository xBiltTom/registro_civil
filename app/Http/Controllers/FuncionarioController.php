<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Acta;
use App\Models\ActaDefunciones;
use App\Models\Persona;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;

class FuncionarioController extends Controller
{
    public function index(){
        return view('Actas.Matrimonios.index');
    }

    public function indexNacimiento(){
        return view('Actas.Nacimientos.index');
    }

    public function registrarActa(){
        return view('Actas.Matrimonios.create');
    }

    public function registrarNacimiento(){
        return view('Actas.Nacimientos.create');
    }
    public function editNacimiento($id){
        return view('Actas.Nacimientos.edit', compact('id'));

    }

    public function pdfNacimiento($id)
    {
        $acta = Acta::find($id);

        if (!$acta || !$acta->actaNacimiento) {
            abort(404, 'Acta o acta de nacimiento no encontrada');
        }

        // Obtener al nacido a través del campo persona_id
        $nacido = Persona::find($acta->persona_id);

        // Obtener a la madre y al padre a través de la relación actaNacimiento
        $madre = Persona::find($acta->actaNacimiento->madre_id);
        $padre = Persona::find($acta->actaNacimiento->padre_id);

        $fecha_actual = now();

        // Generar el PDF
        $pdf = Pdf::loadView('nacimientosPdf', compact('acta', 'nacido', 'madre', 'padre', 'fecha_actual'));
        return $pdf->stream();
    }

    public function pdf($id){
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
        return view('Actas.Matrimonios.edit', ['id' => $id]);

    }

    public function mostrarActaDefunciones(){
        return view('Actas.defunciones.index');
    }

    public function registrarActaDefunciones(){
        return view('Actas.defunciones.create');
    }

    public function editarActaDefunciones($id){
        return view('Actas.defunciones.edit',compact('id'));
    }
}
