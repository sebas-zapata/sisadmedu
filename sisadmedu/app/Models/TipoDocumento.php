<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TipoDocumento extends Model
{ 
    // Importar el trait HasFactory para usar las fábricas de Eloquent
    use HasFactory;

    // Definición de la tabla y clave primaria
    protected $table = 'tipos_documento';
    protected $primaryKey = 'id';
    public $timestamps = true;

    // Campos que se pueden asignar masivamente
    protected $fillable = [
        'codigo',
        'descripcion',
    ];

    // Relación con el modelo de usuarios
    public function usuarios()
    {
        return $this->hasMany(Usuario::class, 'tipo_documento_id');
    }

    // Relación con el modelo de estudiantes
    public function estudiantes()
    {
        return $this->hasMany(Estudiante::class, 'id_tipo_documento');

    }

    // Relación con el modelo de docentes
    public function docentes()
    {
        return $this->hasMany(Docente::class, 'id_tipo_documento');
    }
}
