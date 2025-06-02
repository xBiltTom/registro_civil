<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    use HasFactory;

    protected $fillable = [
        'dni', 'nombre', 'apellido', 'sexo', 
        'nacionalidad', 'pertenece_pueblo'
    ];

    public function lugar()
    {
        return $this->belongsTo(Lugar::class);
    }

    public function actas()
    {
        return $this->hasMany(Acta::class);
    }

    public function actasNacimiento()
    {
        return $this->belongsToMany(ActaNacimiento::class, 'acta_nacimiento_persona');
    }

    public function actasMatrimonio()
    {
        return $this->belongsToMany(ActaMatrimonio::class, 'acta_matrimonio_persona');
    }

    public function actasDefuncion()
    {
        return $this->belongsToMany(ActaDefuncion::class, 'acta_defuncion_persona');
    }
}
