<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EstadoSolicitud extends Model
{
    protected $table = "estado_solicitud";

    public function solicitudes()
    {
        return $this->hasMany(Solicitud::class, 'estado_id');
    }
}
