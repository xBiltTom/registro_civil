<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ActaMatrimonio extends Model
{

    use HasFactory;

    protected $table = 'acta_matrimonios';


    // Indica que la clave primaria es acta_id y no es autoincremental
    protected $primaryKey = 'acta_id';
    public $incrementing = false;
    protected $keyType = 'int';

    protected $fillable = [
        'acta_id',
        'novio_id',
        'novia_id',
        'fecha_matrimonio',
        'testigo1_id',
        'testigo2_id',
        
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
        return $this->belongsTo(Acta::class, 'acta_id');
    }

    
}
