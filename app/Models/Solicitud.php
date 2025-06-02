<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Solicitud extends Model
{
    use HasFactory;

    protected $fillable = [
        'acta_id',
        'user_id',
        'pago_id',
        'estado'
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
}
