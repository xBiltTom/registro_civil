<?php

namespace App\Livewire\Usuarios;

use Livewire\Component;
use App\Models\User;
use App\Models\Persona;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;

class ListarUsuarios extends Component

{
    use WithPagination;
    protected $paginationTheme = 'tailwind';
    public $buscado;

    public function placeholder()
    {
        return view('placeholder');
    }

    public function reiniciar(){
        $this->resetPage();
    }

    public function render()
{
    // Obtener IDs únicos de usuarios conectados
    $usuariosConectados = DB::table('sessions')
        ->whereNotNull('user_id')
        ->pluck('user_id')
        ->unique();

    // Traer los usuarios y ordenarlos: conectados primero
    $usuarios = User::where(function ($query) {
        if ($this->buscado) {
            $query->where('name', 'like', '%' . $this->buscado . '%')
                ->orWhere('email', 'like', '%' . $this->buscado . '%');
        }
    })
    ->orderByRaw("FIELD(id, " . $usuariosConectados->implode(',') . ") DESC")
    ->paginate(5);

    return view('livewire.usuarios.listar-usuarios', [
        'usuarios' => $usuarios
    ]);
}

    public function borrar($id)
    {
        $user = User::find($id);
        if ($user) {
            $user->estado = 0;
            $user->save();
            session()->flash('message', 'Usuario eliminado exitosamente');
        } else {
            session()->flash('error', 'Usuario no encontrado');
        }
    }
}
