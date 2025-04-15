<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    protected $table = 'usuarios';
    protected $primaryKey = 'id_usuario';
    public $timestamps = false;

    protected $fillable = [
        'documento_usuario',
        'nombres_usuario',
        'apellidos_usuario',
        'telefono_usuario',
        'contrasena_usuario',
        'rol_id_rol',
        'tipo_documento_codigo_tipo_documento',
        'grupo_id_grupo',
        'rol_id_rol1',
        'id_rol',
        'correo_electronico_usuario'
    ];

    // Relación con el tipo de documento
    public function tipoDocumento()
    {
        return $this->belongsTo(TipoDocumento::class, 'tipo_documento_codigo_tipo_documento', 'codigo_tipo_documento');
    }

    // Relación con el rol
    public function rol()
    {
        return $this->belongsTo(Rol::class, 'rol_id_rol', 'id_rol');
    }

    // Relación con el grupo
    public function grupo()
    {
        return $this->belongsTo(Grupo::class, 'grupo_id_grupo', 'id_grupo');
    }
}