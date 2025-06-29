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
}
