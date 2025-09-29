<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Testing\Fluent\Concerns\Has;

class LoginUsuario extends Authenticatable
{
    // Importar el trait Notifiable para enviar notificaciones
    use Notifiable, HasFactory;

    // Definición de la tabla y clave primaria
    protected $table = 'usuarios';
    protected $primaryKey = 'id';


    // Campos que se pueden asignar masivamente
    // En este caso, solo los campos necesarios para la autenticación
    // Se debe tener cuidado de no incluir campos sensibles como contraseñas en las respuestas JSON
    protected $fillable = [
        'nombres',
        'apellidos',
        'celular',
        'correo_electronico',
        'contrasena',
    ];

    protected $hidden = [
        'contrasena',
    ];

    // muy importante: indicar a Auth cuál es el campo de password
    public function getAuthPassword()
    {
        return $this->contrasena;
    }

    public function rol()
    {
        return $this->belongsTo(Rol::class, 'rol_id');
    }
}
