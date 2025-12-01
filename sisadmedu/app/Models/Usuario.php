<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Usuario extends Model
{
    use HasFactory;

    protected $table = 'usuarios';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'documento',
        'nombres',
        'apellidos',
        'correo_electronico',
        'celular',
        'contrasena',
        'usuario_id',
        'rol_id',
        'tipo_documento_id',
    ];

    // Un usuario pertenece a un rol
    public function rol()
    {
        return $this->belongsTo(Rol::class, 'rol_id');
    }

    // Un usuario pertenece a un tipo de documento
    public function tipoDocumento()
    {
        return $this->belongsTo(TipoDocumento::class, 'tipo_documento_id');
    }

    // Relación muchos a muchos con estudiantes como acudiente
    public function estudiantes()
    {
        return $this->belongsToMany(Estudiante::class, 'acudiente_estudiante', 'acudiente_id', 'estudiante_id');
    }

    // Un usuario puede ser un docente
    public function docente()
    {
        return $this->hasOne(Docente::class, 'usuario_id','id');
    }

    // Un usuario puede ser un estudiante (relación 1 a 1)
    public function estudiante()
    {
        return $this->hasOne(Estudiante::class, 'usuario_id', 'id');
    }

    
}