<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FuncionarioController extends Controller
{
    public function index(){
        return view('Actas.Matrimonios.index');
    }

    public function registrarActa(){
        return view('Actas.Matrimonios.create');
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
