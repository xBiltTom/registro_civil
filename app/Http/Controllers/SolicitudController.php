<?php

namespace App\Http\Controllers;

use App\Models\Acta;
use App\Models\Solicitud;
use Illuminate\Http\Request;

class SolicitudController extends Controller
{
    //

    public function solicitudes(){
        $this->authorize('viewAny', Solicitud::class);
        return view('solicitudes.index');
    }

    public function historialSolicitudes(){
        $this->authorize('viewAny', Solicitud::class);
        return view('solicitudes.historial');
    }

    public function atenderSolicitud($id){
        $this->authorize('viewAny', Acta::class);
        $solicitud = Solicitud::findOrFail($id);
        if($solicitud){
            $acta = Acta::findOrFail($solicitud->acta_id);
            $this->authorize('viewAny', Acta::class);
            if($solicitud->estado_id==1){
                return view('solicitudes.atencion',compact('id'));
            }
        }
        return redirect()->route('solicitudes')->with('error', 'Solicitud no encontrada');
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
