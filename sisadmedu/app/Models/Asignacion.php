<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asignacion extends Model
{
    use HasFactory;

    protected $table = 'asignaciones';

    protected $fillable = [
        'docente_id',
        'materia_id',
        'grado_id',
        'anio_lectivo',
    ];

    // Relaciones
    public function docente()
    {
        return $this->belongsTo(Docente::class);
    }

    public function materia()
    {
        return $this->belongsTo(Materia::class);
    }

    public function grado()
    {
        return $this->belongsTo(Grado::class);
    }
}
