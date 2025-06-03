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
}
