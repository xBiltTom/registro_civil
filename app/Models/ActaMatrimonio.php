<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActaMatrimonio extends Model
{
    protected $fillable = [
        'novio_id',
        'novia_id',
        'fecha_matrimonio',
        'testigo1_id',
        'testigo2_id',
        'acta_id'
    ];

    public function novio()
    {
        return $this->belongsTo(Persona::class, 'novio_id');
    }

    public function novia()
    {
        return $this->belongsTo(Persona::class, 'novia_id');
    }

    public function testigo1()
    {
        return $this->belongsTo(Persona::class, 'testigo1_id');
    }

    public function testigo2()
    {
        return $this->belongsTo(Persona::class, 'testigo2_id');
    }

    public function acta()
    {
        return $this->belongsTo(Acta::class);
    }

    public function personas()
    {
        return $this->belongsToMany(Persona::class, 'acta_matrimonio_persona');
    }
}
