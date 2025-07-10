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
        if(auth()->user()->estado == 0){
            return redirect()->route('verificacion')->with('error', 'No tienes permisos para acceder a esta sección.');
        }
        return view('personal.solicitudes.index');
    }

    public function solicitudesGenerales(){
        return view('solicitudes.general');
    }

    public function mostrarSolicitud($id)
    {
        if (auth()->user()->estado == 0) {
            return redirect()->route('verificacion')->with('error', 'No tienes permisos para acceder a esta sección.');
        }

        $solicitud = Solicitud::findOrFail($id);
        $this->authorize('view', $solicitud);

        return view('solicitudes.show', compact('id'));
    }

    public function registrarSolicitud($id){
        if(auth()->user()->estado == 0){
            return redirect()->route('verificacion')->with('error', 'No tienes permisos para acceder a esta sección.');
        }
        $acta = Acta::findOrFail($id);
        $this->authorize('view', $acta);
        return view('personal.solicitudes.create',compact('id'));
    }
}
