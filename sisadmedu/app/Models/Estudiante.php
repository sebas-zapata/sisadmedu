<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Estudiante extends Model
{
    use HasFactory;

    protected $table = 'estudiantes';

    protected $primaryKey = 'id';
    public $incrementing = true;

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
        'usuario_id', // importante para la relación con usuarios 
    ];

    // 🔹 Un estudiante pertenece a un grado
    public function grado()
    {
        return $this->belongsTo(Grado::class, 'id_grado', 'id');
    }

    // 🔹 Un estudiante pertenece a un tipo de documento
    public function tipoDocumento()
    {
        return $this->belongsTo(TipoDocumento::class, 'id_tipo_documento');
    }

    // 🔹 Relación muchos a muchos con acudientes (usuarios)
    public function acudientes()
    {
        return $this->belongsToMany(Usuario::class, 'acudiente_estudiante', 'estudiante_id', 'acudiente_id');
    }

    // 🔹 Un estudiante puede tener varias observaciones
    public function observaciones()
    {
        return $this->hasMany(Observacion::class, 'estudiante_id');
    }

    // 🔹 Relación directa con el usuario (rol estudiante)
    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'usuario_id');
    }

    public function loginUsuario()
    {
        return $this->belongsTo(LoginUsuario::class, 'usuario_id');
    }
}
