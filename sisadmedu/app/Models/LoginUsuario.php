<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class LoginUsuario extends Authenticatable
{
    use Notifiable;

    protected $table = 'usuarios';

    protected $fillable = [
        'correo_electronico',
        'contrasena',
    ];

    public $timestamps = false;

    public function getAuthIdentifierName()
    {
        return 'correo_electronico'; // campo que usas para login
    }
}
