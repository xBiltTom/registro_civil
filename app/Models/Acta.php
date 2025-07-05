<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Acta extends Model
{
    use HasFactory;

    public $incrementing = false;      // El id NO es autoincremental
    /* protected $keyType = 'String'; */


    protected $casts = [
        'id' => 'string',
    ];

    protected $fillable = [
        'id',
        'identificador',
        'fecha_registro',
        'persona_id',
        'folio_id',
        'user_id',
        'tipo_id',
        /* 'ruta_pdf' */
    ];

    public function persona()
    {
        return $this->belongsTo(Persona::class);
    }

    public function folio()
    {
        return $this->belongsTo(Folio::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function solicitud()
    {
        return $this->hasOne(Solicitud::class);
    }

    public function actaNacimiento()
    {
        return $this->hasOne(ActaNacimiento::class, 'acta_id'); // Clave foránea explícita
    }

    public function actaMatrimonio()
    {
        return $this->hasOne(ActaMatrimonio::class,'acta_id');
    }

    public function actaDefuncion()
    {
        return $this->hasOne(ActaDefuncion::class, 'acta_id'); // Clave foránea explícita
    }

    public function tipo(){
        return $this->belongsTo(TipoActa::class,'tipo_id','id');
    }
}
