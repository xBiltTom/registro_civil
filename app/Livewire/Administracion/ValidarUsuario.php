<?php

namespace App\Livewire\Administracion;

use Livewire\Component;
use App\Models\Verificar;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class ValidarUsuario extends Component
{
    public $solicitudes = [];
    public $solicitudSeleccionada = null;
    public $mostrarModal = false;
    public $motivoRechazo = '';

    public function mount()
    {
        $this->cargarSolicitudes();
    }

    public function cargarSolicitudes()
    {
        // Obtener todas las verificaciones pendientes con sus usuarios relacionados
        $this->solicitudes = Verificar::with('usuar')
            ->whereHas('usuar', function($query) {
                $query->where('estado_verificacion', 1);
            })
        /*     ->latest() */
            ->get();
    }

    public function verDetalles($id)
    {
        $this->solicitudSeleccionada = Verificar::with('usuar')->find($id);
        $this->mostrarModal = true;
    }

    public function aprobarUsuario($id)
{
    $verificacion = Verificar::with('usuar')->find($id);

    if ($verificacion && $verificacion->usuar) {
        // Actualizar estado del usuario a activo
        $usuario = $verificacion->usuar; // CORREGIDO: usuar en lugar de usuario
        $verificacion->estado_verificacion = '2';
        $usuario->estado = '1';
        $verificacion->save(); // También guardar los cambios en verificación
        $usuario->save();

        $this->dispatch('mostrarMensaje', [
            'tipo' => 'success',
            'titulo' => 'Usuario validado',
            'mensaje' => "El usuario {$usuario->name} ha sido validado y activado correctamente."
        ]);
    }

    $this->mostrarModal = false;
    $this->solicitudSeleccionada = null;
    $this->cargarSolicitudes();
}

    public function rechazarUsuario($id)
    {
        $verificacion = Verificar::with('usuar')->find($id);

        if ($verificacion) {
            // Eliminar imágenes almacenadas
            if (Storage::disk('public')->exists($verificacion->dni_anverso)) {
                Storage::disk('public')->delete($verificacion->dni_anverso);
            }

            if (Storage::disk('public')->exists($verificacion->dni_reverso)) {
                Storage::disk('public')->delete($verificacion->dni_reverso);
            }

            if (Storage::disk('public')->exists($verificacion->foto)) {
                Storage::disk('public')->delete($verificacion->foto);
            }

            $nombreUsuario = $verificacion->usuario ? $verificacion->usuario->name : 'Usuario desconocido';

            // Eliminar la solicitud
            $verificacion->delete();

            $this->dispatch('mostrarMensaje', [
                'tipo' => 'warning',
                'titulo' => 'Solicitud rechazada',
                'mensaje' => "La solicitud de verificación de {$nombreUsuario} ha sido rechazada."
            ]);
        }

        $this->motivoRechazo = '';
        $this->mostrarModal = false;
        $this->solicitudSeleccionada = null;
        $this->cargarSolicitudes();
    }

    public function render()
    {
        return view('livewire.administracion.validar-usuario');
    }
}
