<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActaDefuncion extends Model
{
    use HasFactory;

    protected $table = 'acta_defunciones';
    protected $primaryKey = 'acta_id';

    protected $casts = [
        'acta_id' => 'string',
    ];

    protected $fillable = [
        'acta_id',
        'fallecido_id',
        'fecha_defuncion',
        'declarante_id',
    ];

    public function fallecido()
    {
        return $this->belongsTo(Persona::class, 'fallecido_id');
    }

    public function declarante()
    {
        return $this->belongsTo(Persona::class, 'declarante_id');
    }

    public function acta()
    {
        return $this->belongsTo(Acta::class, 'acta_id'); // Clave foránea = PK
    }

    public function personas()
    {
        return $this->belongsToMany(Persona::class, 'acta_defuncion_persona');
    }
}
