<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    use HasFactory;

    protected $fillable = ['monto', 'ruta_voucher'];

    public function solicitud()
    {
        return $this->hasOne(Solicitud::class);
    }
}
