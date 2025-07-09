<?php

namespace App\Livewire\Solicitudes;

use App\Models\Solicitud;
use Livewire\Component;

class Atencion extends Component
{

    public $id;
    public $solicitud;
    public $id_acta;
    public $acta;
    public $user_id;
    public $funcionario_id;
    public $pago_id;
    public $estado_id;
    public $monto;
    public $ruta_voucher;
    public $numero_voucher;
    public $fecha_voucher;
    public $motivo_rechazo;

    public function mount($id){
        $this->id = $id;
        $this->solicitud = Solicitud::findOrFail($id);
        if($this->solicitud){
            $this->id_acta = $this->solicitud->acta_id;
            $this->acta = $this->solicitud->acta;
            $this->user_id = $this->solicitud->user_id;
            $this->funcionario_id = $this->solicitud->funcionario_id;
            $this->pago_id = $this->solicitud->pago_id;
            $this->estado_id = $this->solicitud->estado_id;
            $this->monto = $this->solicitud->pago ? $this->solicitud->pago->monto : null;
            $this->ruta_voucher = $this->solicitud->pago ? $this->solicitud->pago->ruta_voucher : null;
            $this->numero_voucher = $this->solicitud->pago ? $this->solicitud->pago->numero : null;
            $this->fecha_voucher = $this->solicitud->pago ? $this->solicitud->pago->fecha_voucher : null;
        }

    }

    public function aceptarSolicitud(){
        $this->verificarAtencion();
        $this->solicitud->detalle = "Atendido con normalidad";
        $this->solicitud->estado_id = 2; // Asumiendo que 2 es el estado de "Atendido"
        $this->solicitud->funcionario_id = auth()->user()->id;
        $this->solicitud->save();
        session()->flash('success', 'Solicitud aceptada y atendida correctamente.');
        return redirect()->route('solicitudes');
    }

    public function rechazarSolicitud(){
       /*  dd(
            $this->motivo_rechazo,
        ); */
        $this->verificarAtencion();
        $this->solicitud->detalle = $this->motivo_rechazo;
        $this->solicitud->funcionario_id = auth()->user()->id;
        $this->solicitud->estado_id = 3; // Asumiendo que 3 es el estado de "Rechazado"
        $this->solicitud->save();
        session()->flash('success', 'Solicitud rechazada correctamente.');
        return redirect()->route('solicitudes');
    }

    public function placeholder(){
        return view('placeholder');
    }

    public function verificarAtencion(){
        if($this->solicitud->estado_id == 2){
            session()->flash('info', 'La solicitud ya ha sido atendida.');
            return redirect()->route('solicitudes');
        }
    }

    public function render()
    {
        return view('livewire.solicitudes.atencion');
    }
}
