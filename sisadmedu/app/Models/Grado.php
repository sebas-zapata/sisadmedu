<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grado extends Model
{
    use HasFactory;

    // Definir los campos que son asignables en masa
    protected $fillable = ['nivel_grado', 'grupo_grado', 'nombre_grado'];
 
    // Relación con el modelo de Estudiante
    public function estudiantes()
    {
        return $this->hasMany(Estudiante::class, 'id_grado');
    }
}
