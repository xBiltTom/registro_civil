<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Verificar extends Model
{
    protected $table = 'verificar';
    public $timestamps = false;
    protected $fillable = [
        'usuario',
        'estado_verificacion',
        'fecha',
        'dni_anverso',
        'dni_reverso',
        'foto'
    ];

    public function usuar()
    {
        return $this->belongsTo(User::class, 'usuario', 'id');
    }
}
