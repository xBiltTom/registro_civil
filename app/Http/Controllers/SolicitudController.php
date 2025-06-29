<?php

namespace App\Http\Controllers;

use App\Models\Acta;
use Illuminate\Http\Request;

class SolicitudController extends Controller
{
    //

    public function solicitudes(){
        $this->authorize('viewAny', Acta::class);
        return view('solicitudes.index');
    }

    public function solicitudesPersonales(){
        return view('personal.solicitudes.index');
    }

    public function registrarSolicitud($id){
        $acta = Acta::findOrFail($id);
        $this->authorize('view', $acta);
        return view('personal.solicitudes.create',compact('id'));
    }
}
