<?php

namespace App\Livewire\Personal;

use Livewire\Component;
use App\Models\Acta;

class Veracta extends Component
{

    public $id_acta;
    public $acta;

    public function mount($id){
        $this->id_acta = $id;
        $this->acta = Acta::find($this->id_acta);
    }

    public function placeholder()
    {
        return view('placeholder');
    }

    public function render()
    {
        return view('livewire.personal.veracta'
            , [
                'acta' => $this->acta,
            ]);
    }
}
