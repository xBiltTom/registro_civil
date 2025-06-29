<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Solicitud extends Model
{
    use HasFactory;
    protected $table = "solicitudes";

    protected $fillable = [
        'acta_id',
        'user_id',
        'funcionario_id',
        'pago_id',
        'estado_id',
        'detalle',
    ];

    public function acta()
    {
        return $this->belongsTo(Acta::class);
    }

    public function pago()
    {
        return $this->belongsTo(Pago::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function estado(){
        return $this->belongsTo(EstadoSolicitud::class, 'estado_id');
    }
}
