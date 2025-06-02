<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActaNacimiento extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre_nacido',
        'apellido_nacido',
        'sexo',
        'fecha_nacimiento',
        'madre_id',
        'padre_id',
        'acta_id',
        'lugar_id'
    ];

    public function acta()
    {
        return $this->belongsTo(Acta::class);
    }

    public function madre()
    {
        return $this->belongsTo(Persona::class, 'madre_id');
    }

    public function padre()
    {
        return $this->belongsTo(Persona::class, 'padre_id');
    }

    public function lugar()
    {
        return $this->belongsTo(Lugar::class);
    }

    public function personas()
    {
        return $this->belongsToMany(Persona::class, 'acta_nacimiento_persona');
    }
}
