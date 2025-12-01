<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Rol extends Model
{
    // Importar el trait HasFactory para usar las fábricas de Eloquent
    use HasFactory;

    // Definición de la tabla y clave primaria
    protected $table = 'roles';
    protected $primaryKey = 'id';
    public $timestamps = true;

    // Campos que se pueden asignar masivamente
    protected $fillable = [
        'nombre',
    ];

    // Relación con el modelo usuario
    public function usuarios()
    {
        return $this->hasMany(Usuario::class, 'rol_id');
    }

    // Relación con el modelo usuario
    public function loginUsuarios()
    {
        return $this->hasMany(LoginUsuario::class, 'rol_id');
    }
}
