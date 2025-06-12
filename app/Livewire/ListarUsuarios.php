<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Models\Persona;

class ListarUsuarios extends Component

{

    protected $paginationTheme = 'tailwind';
    public $buscado;

    public function placeholder()
    {
        return view('placeholder');
    }

    public function render()
    {
        $usuarios = User::where(function ($query) {
            if ($this->buscado) {
                $query->where('name', 'like', '%' . $this->buscado . '%')
                      ->orWhere('email', 'like', '%' . $this->buscado . '%');
            }
        })->paginate(5);

        return view('livewire.usuarios.listar-usuarios',compact('usuarios') );
    }
}
