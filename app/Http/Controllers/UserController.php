<?php

namespace App\Http\Controllers;

use App\Models\Acta;
use Illuminate\Http\Request;
use App\Models\Persona;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    use AuthorizesRequests;

    public function __construct(){
        $this->authorizeResource(User::class);
    }

    public function index()
    {
        return view('Usuarios.listar-usuarios');
    }

    public function mostrarActasPersonales(){
        if(auth()->user()->estado == 0){
            return redirect()->route('verificacion')->with('error', 'No tienes permisos para acceder a esta sección.');
        }
        return view('personal.actas.index');
    }

    public function verificacion(){
        if(auth()->user()->estado == 1){
            return redirect()->route('dashboard');
        }
        return view('personal.verificacion.index');
    }

    public function mostrarActa($id){
        if(auth()->user()->estado == 0){
            return redirect()->route('verificacion')->with('error', 'No tienes permisos para acceder a esta sección.');
        }
        $acta = Acta::findOrFail($id);
        $this->authorize('view', $acta);
        return view('personal.actas.show',compact('id'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Usuarios.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('Usuarios.edit', ['id' => $id]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
