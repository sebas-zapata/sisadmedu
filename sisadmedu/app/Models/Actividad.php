<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Actividad extends Model
{
    protected $table = 'actividades';

    protected $fillable = [
        'asignacion_id', // Relación con la asignación
        'descripcion',   // Nombre de la actividad
        'periodo_id',
    ];

    // Relación con Asignación
    public function asignacion()
    {
        return $this->belongsTo(Asignacion::class);
    }

    public function detallesNotas()
    {
        return $this->hasMany(DetalleNota::class);
    }
    public function periodo()
    {
        return $this->belongsTo(Periodo::class, 'periodo_id');
    }
}
