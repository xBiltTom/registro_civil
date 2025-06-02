<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lugar extends Model
{
    use HasFactory;

    protected $table = 'lugar';

    protected $fillable = [
        'distrito', 'provincia', 'departamento', 'pais'
    ];

    public function personas()
    {
        return $this->hasMany(Persona::class);
    }
}
