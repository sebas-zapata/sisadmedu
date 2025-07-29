<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Grupo extends Model
{
    // Importar el trait HasFactory para usar las fábricas de Eloquent
    use HasFactory;

    // Definición de la tabla y clave primaria
    protected $table = 'grupos';
    protected $primaryKey = 'id';
    public $timestamps = true;

    // Campos que se pueden asignar masivamente
    protected $fillable = [
        'nombre',
    ];
}
