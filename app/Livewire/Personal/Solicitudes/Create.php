<?php

namespace App\Livewire\Personal\Solicitudes;

use App\Models\Acta;
use App\Models\Pago;
use App\Models\Solicitud;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;

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


    public function registrarSolicitud(){
        /* $pago = new Pago();
        $solicitud = new Solicitud();
        dd(
            $pago->numero = $this->numero_voucher,
            $pago->monto = 10.00,
            $pago->ruta_voucher = $this->ruta_voucher->store('vouchers'),
            $pago->fecha_voucher = $this->fecha_voucher,

            $solicitud->acta_id = $this->id_acta,
            $solicitud->user_id = auth()->user()->id,
            $solicitud->funcionario_id = null, // Asignar el funcionario si es necesario
            $solicitud->pago_id = $pago->id, // Asignar el ID del pago creado
            $solicitud->estado_id = 1, // Estado inicial
        ); */
        $this->validate([
            'ruta_voucher' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'numero_voucher' => 'required|string|max:8',
            'fecha_voucher' => 'required|date',
        ],[
            'ruta_voucher.required' => 'El voucher es obligatorio.',
            'ruta_voucher.file' => 'El voucher debe ser un archivo.',
            'ruta_voucher.mimes' => 'El voucher debe ser un archivo de tipo: jpg, jpeg, png, pdf.',
            'ruta_voucher.max' => 'El voucher no debe exceder los 2MB.',
            'numero_voucher.required' => 'El número de voucher es obligatorio.',
            'numero_voucher.string' => 'El número de voucher debe ser una cadena de texto.',
            'numero_voucher.max' => 'El número de voucher no debe exceder los 8 caracteres.',
            'fecha_voucher.required' => 'La fecha del voucher es obligatoria.',
            'fecha_voucher.date' => 'La fecha del voucher debe ser una fecha válida.',
        ]);

        if(!$this->ruta_voucher || !$this->numero_voucher){
            session()->flash('error', 'Debe subir un voucher y un número de voucher.');
            return;
        }

        //Creando el pago primero:
        $pago = new Pago();
        $pago->numero = $this->numero_voucher;
        $pago->monto = 10.00;
        $pago->ruta_voucher = $this->ruta_voucher->store('vouchers');
        $pago->fecha_voucher = $this->fecha_voucher;
        $pago->save();

        //Luego creando la solicitud:
        $solicitud = new Solicitud();
        $solicitud->acta_id = $this->id_acta;
        $solicitud->user_id = auth()->user()->id;
        $solicitud->funcionario_id = null; // Asignar el funcionario si es necesario
        $solicitud->pago_id = $pago->id; // Asignar el ID del pago creado
        $solicitud->estado_id = 1; // Estado inicial
        $solicitud->save();

        session()->flash('message', 'La solicitud se registró exitosamente');
        return redirect()->route('personal');
    }

    public function mount($id){
        $this->id_acta = $id;
        $this->acta = Acta::find($this->id_acta);
    }

    public function render()
    {
        return view('livewire.personal.solicitudes.create');
    }
}
