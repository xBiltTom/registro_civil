<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoActa extends Model
{
    protected $table = "tipo_acta";

    public function acta(){
        return $this->hasMany(Acta::class,'tipo_id','id');
    }
}
