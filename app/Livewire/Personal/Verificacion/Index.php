<?php

namespace App\Livewire\Personal\Verificacion;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Verificar;
use Illuminate\Support\Facades\Auth;

class Index extends Component
{
    use WithFileUploads;

    public $dni_anverso;
    public $dni_reverso;
    public $foto;

    protected function rules()
    {
        return [
            'dni_anverso' => 'required|image', // Eliminada la restricción de tamaño
            'dni_reverso' => 'required|image',
            'foto' => 'required|image',
        ];
    }

    protected function messages()
    {
        return [
            'dni_anverso.required' => 'La imagen del anverso del DNI es obligatoria',
            'dni_anverso.image' => 'El archivo debe ser una imagen',

            'dni_reverso.required' => 'La imagen del reverso del DNI es obligatoria',
            'dni_reverso.image' => 'El archivo debe ser una imagen',

            'foto.required' => 'La foto personal es obligatoria',
            'foto.image' => 'El archivo debe ser una imagen',
        ];
    }

    public function enviarVerificacion()
    {
        $this->validate();

        // Verificar que los archivos existan
        if(!$this->dni_anverso || !$this->dni_reverso || !$this->foto) {
            session()->flash('error', 'Debe subir las tres imágenes requeridas.');
            return;
        }

        // Obtener el usuario actual
        $usuario = Auth::id();

        // Guardar las imágenes en el storage - usando el mismo patrón que en Create.php
        $dniAnversoPath = $this->dni_anverso->store('verificacion/dni', 'public');
        $dniReversoPath = $this->dni_reverso->store('verificacion/dni', 'public');
        $fotoPath = $this->foto->store('verificacion/fotos', 'public');

        // Crear registro en la tabla verificar
        Verificar::create([
            'usuario' => $usuario,
            'estado_verificacion' => 1, // Estado inicial, puede ser 'pendiente' o similar
            'fecha'=> now(), // Fecha actual
            'dni_anverso' => $dniAnversoPath,
            'dni_reverso' => $dniReversoPath,
            'foto' => $fotoPath
        ]);

            // Mensaje de éxito utilizando el método de flash como en Create.php
            session()->flash('mensaje', 'Tu verificación ha sido enviada. Un administrador revisará tu información pronto.');

            // Redireccionar a una página apropiada después del éxito (como en Create.php)
            // Puedes ajustar la ruta según sea necesario
            /* return redirect()->route('home'); */


    }

    public function render()
    {
        return view('livewire.personal.verificacion.index');
    }
}
