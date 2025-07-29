<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    // Importar el trait HasFactory para usar las fábricas de Eloquent
    use HasFactory;

    // Definición de la tabla y clave primaria
    protected $table = 'usuarios';
    protected $primaryKey = 'id';
    public $timestamps = true;

    // Campos que se pueden asignar masivamente
    protected $fillable = [
        'documento',
        'nombres',
        'apellidos',
        'correo_electronico',
        'telefono',
        'contrasena',
        'rol_id',
        'tipo_documento_id',
    ];

    // Relación con el modelo Rol
    public function rol()
    {
        return $this->belongsTo(Rol::class, 'rol_id');
    }

    // Relación con el modelo TipoDocumento
    public function tipoDocumento()
    {
        return $this->belongsTo(TipoDocumento::class, 'tipo_documento_id');
    }
}
