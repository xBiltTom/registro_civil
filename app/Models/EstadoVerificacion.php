<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EstadoVerificacion extends Model
{
    protected $table = 'estado_verificacion';
    protected $fillable = [
        'descripcion',
    ];

    public function verificacion(){
        return $this->hasMany('App\Models\Verificacion', 'estado_verificacion', 'id');
    }
}
