<?php

namespace App\Livewire\Solicitudes;

use App\Models\Acta;
use Livewire\Component;
use App\Models\Solicitud;
use App\Models\EstadoSolicitud;
use App\Models\PagoPeriodo;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $mostrarModalPeriodo = false;
    public $fechaInicio;
    public $fechaFin;
    public $monto;
    public $periodoSeleccionado = null;
    public $periodos = [];

    public function mount()
    {
        // Inicializar con fecha actual
        $this->fechaInicio = now()->format('Y-m-d');
        $this->fechaFin = now()->addMonths(1)->format('Y-m-d');
        $this->cargarPeriodos();
    }

    public function cargarPeriodos()
    {
    // Traer primero el periodo activo, y luego los demás ordenados por fecha
        $periodoActivo = PagoPeriodo::where('estado', 1)->first();
        $otrosPeriodos = PagoPeriodo::where('estado', 0)->orderBy('inicio', 'desc')->get();

    // Combinar los resultados
        $this->periodos = collect([$periodoActivo])->filter()->merge($otrosPeriodos);
    }

    public function activarPeriodo($id)
    {
        try {
            // Encontrar el periodo seleccionado
            $periodoSeleccionado = PagoPeriodo::find($id);

            if (!$periodoSeleccionado) {
                $this->dispatch('mostrarMensaje', [
                    'tipo' => 'error',
                    'titulo' => 'Error',
                    'mensaje' => 'No se encontró el periodo seleccionado'
                ]);
                return;
            }

            // Verificar si ya está activo
            if ($periodoSeleccionado->estado == 1) {
                $this->dispatch('mostrarMensaje', [
                    'tipo' => 'info',
                    'titulo' => 'Información',
                    'mensaje' => 'Este periodo ya está activo'
                ]);
                return;
            }

            // Transacción para asegurar que solo un periodo esté activo
            \DB::transaction(function() use ($periodoSeleccionado) {
                // Desactivar todos los periodos
                PagoPeriodo::where('estado', 1)->update(['estado' => 0]);

                // Activar el periodo seleccionado
                $periodoSeleccionado->estado = 1;
                $periodoSeleccionado->save();
            });

            $this->dispatch('mostrarMensaje', [
                'tipo' => 'success',
                'titulo' => 'Periodo activado',
                'mensaje' => 'El periodo de pago ha sido activado correctamente. Se utilizará para nuevas solicitudes.'
            ]);

            // Recargar los periodos para actualizar la vista
            $this->cargarPeriodos();

        } catch (\Exception $e) {
            $this->dispatch('mostrarMensaje', [
                'tipo' => 'error',
                'titulo' => 'Error',
                'mensaje' => 'Ocurrió un error al activar el periodo: ' . $e->getMessage()
            ]);
        }
    }

    public function abrirModalPeriodo()
    {
        $this->mostrarModalPeriodo = true;
    }

    public function cerrarModalPeriodo()
    {
        $this->mostrarModalPeriodo = false;
        $this->reset(['fechaInicio', 'fechaFin', 'monto', 'periodoSeleccionado']);
        $this->fechaInicio = now()->format('Y-m-d');
        $this->fechaFin = now()->addMonths(1)->format('Y-m-d');
    }

    public function seleccionarPeriodo($id)
    {
        $this->periodoSeleccionado = PagoPeriodo::find($id);
        $this->fechaInicio = $this->periodoSeleccionado->inicio;
        $this->fechaFin = $this->periodoSeleccionado->fin;
        $this->monto = $this->periodoSeleccionado->monto;
    }

    public function guardarPeriodo()
    {
        $this->validate([
            'fechaInicio' => 'required|date',
            'fechaFin' => 'required|date|after:fechaInicio',
            'monto' => 'required|numeric|min:0',
        ], [
            'fechaInicio.required' => 'La fecha de inicio es obligatoria',
            'fechaFin.required' => 'La fecha de fin es obligatoria',
            'fechaFin.after' => 'La fecha de fin debe ser posterior a la fecha de inicio',
            'monto.required' => 'El monto es obligatorio',
            'monto.numeric' => 'El monto debe ser un valor numérico',
            'monto.min' => 'El monto no puede ser negativo',
        ]);

        try {
            if ($this->periodoSeleccionado) {
                // Actualizar periodo existente
                $this->periodoSeleccionado->inicio = $this->fechaInicio;
                $this->periodoSeleccionado->fin = $this->fechaFin;
                $this->periodoSeleccionado->monto = $this->monto;
                $this->periodoSeleccionado->save();

                $mensaje = 'Periodo de pago actualizado correctamente';
            } else {
                // Crear nuevo periodo
                PagoPeriodo::create([
                    'inicio' => $this->fechaInicio,
                    'fin' => $this->fechaFin,
                    'monto' => $this->monto,
                    'estado' => 0, // Por defecto, el nuevo periodo no está activo
                ]);

                $mensaje = 'Nuevo periodo de pago creado correctamente';
            }

            $this->dispatch('mostrarMensaje', [
                'tipo' => 'success',
                'titulo' => 'Operación exitosa',
                'mensaje' => $mensaje
            ]);

            $this->cargarPeriodos();
            $this->cerrarModalPeriodo();

        } catch (\Exception $e) {
            $this->dispatch('mostrarMensaje', [
                'tipo' => 'error',
                'titulo' => 'Error',
                'mensaje' => 'Ocurrió un error al guardar el periodo: ' . $e->getMessage()
            ]);
        }
    }

    public function eliminarPeriodo($id)
    {
        try {
            $periodo = PagoPeriodo::find($id);

            // Verificar si hay pagos asociados
            if ($periodo->pagos()->count() > 0) {
                $this->dispatch('mostrarMensaje', [
                    'tipo' => 'error',
                    'titulo' => 'No se puede eliminar',
                    'mensaje' => 'Este periodo tiene pagos asociados y no puede ser eliminado'
                ]);
                return;
            }

            $periodo->delete();

            $this->dispatch('mostrarMensaje', [
                'tipo' => 'success',
                'titulo' => 'Operación exitosa',
                'mensaje' => 'Periodo de pago eliminado correctamente'
            ]);

            $this->cargarPeriodos();

        } catch (\Exception $e) {
            $this->dispatch('mostrarMensaje', [
                'tipo' => 'error',
                'titulo' => 'Error',
                'mensaje' => 'Ocurrió un error al eliminar el periodo: ' . $e->getMessage()
            ]);
        }
    }

    public function render()
    {
        /* $solicitudes = Solicitud::with('acta'); */
        $solicitudes = Solicitud::with(['acta', 'user.persona'])
            ->whereHas('acta', function ($query) {
                $query->where('estado_id', 1);
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        $estados = EstadoSolicitud::all();

        return view('livewire.solicitudes.index', [
            'solicitudes' => $solicitudes,
            'estados' => $estados,
        ]);
    }
}
