<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Folio extends Model
{
    use HasFactory;

    public $incrementing = false;      // El id NO es autoincremental
    protected $keyType = 'int';

    protected $fillable = ['id','libro_id']; //protege los campos que se pueden asignar masivamente

    public function libro()
    {
        return $this->belongsTo(Libro::class);
    }
    public function acta()
    {
        return $this->hasOne(Acta::class);
    }
}
