<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Materia extends Model
{
    // Importar el trait HasFactory para usar las fábricas de Eloquent
    use HasFactory;

    // Definición de la tabla
    protected $table = 'materias';

    // Definición de campos que se pueden asignar masivamente
    protected $fillable = ['descripcion'];

    //relaciones con materias

    public function asignaciones()
    {
        return $this->hasMany(Asignacion::class);
    }

    public function docentes()
    {
        return $this->belongsToMany(Docente::class, 'asignaciones', 'materia_id', 'docente_id')
            ->withPivot('grado_id', 'anio_lectivo')
            ->withTimestamps();
    }
}
