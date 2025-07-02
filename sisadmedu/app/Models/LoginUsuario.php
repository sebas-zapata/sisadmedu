<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class LoginUsuario extends Authenticatable
{
    use Notifiable;

    protected $table = 'usuarios'; // Tu tabla real

    protected $fillable = [
        'correo_electronico', // o como se llame
        'contrasena',
    ];

    public $timestamps = false;

    public function getAuthIdentifierName()
    {
        return 'correo_electronico'; // campo que usas para login
    }
}
