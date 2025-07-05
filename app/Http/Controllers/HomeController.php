<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class HomeController extends Controller
{

    public function dashboard()
    {
        $usuario = auth()->user();
        if($usuario->hasRole('admin')) {
            return view('dashboard');
        } elseif($usuario->hasRole('funcionario')) {
            return view('funcionario-dashboard');
        } else{
            return view('personal.home.index');
        }
    }
}
