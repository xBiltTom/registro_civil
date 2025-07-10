<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    use HasFactory;
    protected $table = 'pagos';

    protected $fillable = ['monto','idmonto', 'ruta_voucher','numero','fecha_voucher'];

    public function solicitud()
    {
        return $this->belongsTo(Solicitud::class,'id','pago_id');
    }

    public function pagoPeriodo()
    {
        return $this->belongsTo(PagoPeriodo::class,'idmonto','id');
    }
}
