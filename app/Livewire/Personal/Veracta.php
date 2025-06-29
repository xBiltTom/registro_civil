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

    public function mount($id){
        $this->id_acta = $id;
        $this->acta = Acta::find($this->id_acta);
        if($this->acta->solicitud){
            $solicitud = Solicitud::find($this->acta->solicitud->id);
            if($solicitud->estado_id==2){
                $this->descargar = 1; // Acta disponible para descargar
            } else {
                $this->descargar = 0; // Acta no disponible para descargar
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
