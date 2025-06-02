<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Models\Persona;

class ListarUsuarios extends Component

{

    public $usuarios;

    public function mount(){
        return $this->usuarios = Persona::all();
    }

    public function render()
    {
        return view('livewire.listar-usuarios');
    }
}
