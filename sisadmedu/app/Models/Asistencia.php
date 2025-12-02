<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asistencia extends Model
{
    use HasFactory;

    protected $table = 'asistencias';

    /**
     * Campos que se pueden asignar masivamente.
     */
    protected $fillable = [
        'estudiante_id',
        'asignacion_id',
        'fecha',
        'estado',
        'justificada',   // booleano: true/false
        'observacion',
    ];

    /**
     * Relación: una asistencia pertenece a un estudiante.
     */
    public function estudiante()
    {
        return $this->belongsTo(Estudiante::class);
    }

    /**
     * Relación: una asistencia pertenece a una asignación
     * (la asignación conecta docente, materia y grado).
     */
    public function asignacion()
    {
        return $this->belongsTo(Asignacion::class);
    }

    /**
     * Accesor para mostrar el estado con formato capitalizado.
     */
    public function getEstadoFormattedAttribute()
    {
        return ucfirst($this->estado);
    }

    /**
     * Accesor para mostrar texto “Sí” o “No” según la justificación.
     */
    public function getJustificadaTextoAttribute()
    {
        return $this->justificada ? 'Sí' : 'No';
    }

    /**
     * Scope para filtrar asistencias por fecha.
     */
    public function scopePorFecha($query, $fecha)
    {
        return $query->whereDate('fecha', $fecha);
    }

    /**
     * Scope para filtrar asistencias por rango de fechas.
     */
    public function scopeEntreFechas($query, $inicio, $fin)
    {
        return $query->whereBetween('fecha', [$inicio, $fin]);
    }
}
