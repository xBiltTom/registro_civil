<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
}
