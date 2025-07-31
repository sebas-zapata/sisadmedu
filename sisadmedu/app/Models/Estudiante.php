<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Estudiante extends Model
{
    use HasFactory;

    protected $table = 'estudiantes';

    protected $primaryKey = 'id_documento_estudiante';
    public $incrementing = false;
    protected $keyType = 'string';

        protected $fillable = [
        'id_documento_estudiante',
        'codigo_estudiante',
        'primer_nombre_estudiante',
        'segundo_nombre_estudiante',
        'primer_apellido_estudiante',
        'segundo_apellido_estudiante',
        'edad_estudiante',
        'fecha_nacimiento_estudiante',
        'celular_estudiante',
        'telefono_estudiante',
        'correo_electronico_estudiante',
        'direccion_estudiante',
        'id_grado',
    ];

    public function grado()
    {
        return $this->belongsTo(Grado::class, 'id_grado');
    }
}
