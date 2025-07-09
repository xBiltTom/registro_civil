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
            if(auth()->user()->estado == 0){
                return redirect()->route('verificacion')->with('error', 'No tienes permisos para acceder a esta sección.');
            }
            return view('personal.home.index');
        }
    }
}
