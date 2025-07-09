<?php

namespace App\Livewire\Usuarios;

use Livewire\Component;

class Conectados extends Component
{

    public $usuario;

    public function mount($usuario){
        $this->usuario = $usuario;
    }

    public function render()
    {
        return view('livewire.usuarios.conectados');
    }
}
