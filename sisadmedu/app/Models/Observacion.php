<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Observacion extends Model
{
    use HasFactory;

    protected $table = 'observaciones';

    protected $fillable = [
        'estudiante_id',
        'docente_id',
        'tipo',
        'descripcion',
    ];
    
    // Relación con Estudiante
    public function estudiante()
    {
        return $this->belongsTo(Estudiante::class, 'estudiante_id');
    }

    // Relación con Docente
    public function docente()
    {
        return $this->belongsTo(Docente::class, 'docente_id');
    }
}

