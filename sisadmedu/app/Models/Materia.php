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

    // Relación con el modelo de Docente
    public function docentes()
    {
        return $this->hasMany(Docente::class, 'id_materia', 'id');
    }
}
