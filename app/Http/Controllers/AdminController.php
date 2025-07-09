<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Models\User;


class AdminController extends Controller
{


    use AuthorizesRequests;

    public function __construct(){
        $this->authorizeResource(User::class);
    }

    public function index(){
        return view('Administracion.index');
    }

    public function reportes(){
        $this->authorize('ver usuarios');
        return view('reportes.index');
    }

    public function validarUsuarios(){
        $this->authorize('ver usuarios');
        return view('Administracion.validar-usuario');
    }
}
