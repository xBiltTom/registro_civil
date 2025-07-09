<?php

namespace App\Livewire\Personal;

use Livewire\Component;
use App\Models\Acta;
use App\Models\Solicitud;

class Veracta extends Component
{

    public $id_acta;
    public $acta;
    public $descargar=0;
    public $solicitada = 0;

    public function mount($id){
        $this->id_acta = $id;
        $this->acta = Acta::find($this->id_acta);
        if($this->acta->solicitud){
            $solicitud = Solicitud::find($this->acta->solicitud->id);
            if($solicitud->estado_id==2 && $solicitud->user_id == auth()->user()->id){
                $this->descargar = 1; // Acta disponible para descargar
            } else {
                $this->descargar = 0; // Acta no disponible para descargar
            }
            if($solicitud->estado_id==1 && $solicitud->user_id == auth()->user()->id){
                $this->solicitada = 1; // Acta ya ha sido solicitada
            } else {
                $this->solicitada = 0; // Acta no ha sido solicitada
            }

        }
    }

    public function actualizar(){
        $this->acta = Acta::find($this->id_acta);

        // Recalcula los valores
        if($this->acta->solicitud){
            $solicitud = Solicitud::find($this->acta->solicitud->id);
            if($solicitud->estado_id==2 && $solicitud->user_id == auth()->user()->id){
                $this->descargar = 1; // Acta disponible para descargar
            } else {
                $this->descargar = 0; // Acta no disponible para descargar
            }
            if($solicitud->estado_id==1 && $solicitud->user_id == auth()->user()->id){
                $this->solicitada = 1; // Acta ya ha sido solicitada
            } else {
                $this->solicitada = 0; // Acta no ha sido solicitada
            }
        }
    }

    public function placeholder()
    {
        return view('placeholder');
    }


    public function solicitarActa(){
        if($this->acta->solicitud){
            redirect()->route('actas.ver', ['id' => $this->acta->id]);
            session()->flash('error', 'El acta ya ha sido solicitada o no está disponible.');
        } else {
            redirect()->route('solicitudes.personal.registrar',['id'=>$this->acta->id]);

        }
    }

    public function render()
    {
        return view('livewire.personal.veracta'
            , [
                'acta' => $this->acta,
            ]);
    }
}
