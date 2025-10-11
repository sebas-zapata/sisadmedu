<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nota extends Model
{
    use HasFactory;

    protected $fillable = [
        'estudiante_id',
        'materia_id',
        'periodo_id',
        'promedio',
    ];

    // Relación con el estudiante
    public function estudiante()
    {
        return $this->belongsTo(Estudiante::class);
    }

    // Relación con la materia
    public function materia()
    {
        return $this->belongsTo(Materia::class);
    }

    // Relación con el periodo
    public function periodo()
    {
        return $this->belongsTo(Periodo::class);
    }

    // Relación con los detalles de la nota
    public function detalles()
    {
        return $this->hasMany(DetalleNota::class);
    }
}
