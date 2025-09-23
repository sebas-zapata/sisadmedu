<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Estudiante extends Model
{
    use HasFactory;

    protected $table = 'estudiantes';

    protected $primaryKey = 'id'; // Ahora será "id"
    public $incrementing = true;  // Autoincrementable

    protected $fillable = [
        'matricula',
        'documento_estudiante',
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
        'id_tipo_documento',
    ];

    public function grado()
    {
        return $this->belongsTo(Grado::class, 'id_grado');
    }

    public function tipodocumento()
    {
        return $this->belongsTo(TipoDocumento::class, 'id_tipo_documento');
    }

    public function acudientes()
    {
        return $this->belongsToMany(Usuario::class, 'acudiente_estudiante', 'estudiante_id', 'acudiente_id')
            ->withTimestamps();
    }

    public function observaciones()
    {
        return $this->hasMany(Observacion::class, 'estudiante_id');
    }
}
