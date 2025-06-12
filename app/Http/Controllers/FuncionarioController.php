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

    public function registrarActa(){
        return view('Actas.Matrimonios.create');
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
