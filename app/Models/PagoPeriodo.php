<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PagoPeriodo extends Model
{
    protected $table = 'pago_periodo';
    public $timestamps = false;
    protected $fillable = [
        'inicio',
        'fin',
        'monto',
        'estado',
    ];

    public function pagos(){
        return $this->hasMany(Pago::class, 'idmonto');
    }
}
