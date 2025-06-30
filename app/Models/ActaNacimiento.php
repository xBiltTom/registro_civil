<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActaNacimiento extends Model
{
    use HasFactory;

    protected $table = 'acta_nacimientos';
    protected $primaryKey = 'acta_id';

    protected $fillable = [
        'nacido_id', // Nuevo campo
        'sexo',
        'fecha_nacimiento',
        'madre_id',
        'padre_id',
        'acta_id',
        'lugar_id',
    ];

    public function acta()
    {
        return $this->belongsTo(Acta::class, 'acta_id');
    }

    public function nacido()
    {
        return $this->belongsTo(Persona::class, 'nacido_id'); // Relación con la persona nacida
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
        return $this->belongsTo(Lugar::class, 'lugar_id');
    }
}
