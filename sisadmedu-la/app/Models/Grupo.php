<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Grupo extends Model
{
    use HasFactory;

    // Tabla correcta
    protected $table = 'grupos';

    // Clave primaria estándar de Laravel
    protected $primaryKey = 'id';

    // Laravel maneja timestamps
    public $timestamps = true;

    protected $fillable = [
        'nombre',
    ];

    // Relación con usuarios
    public function usuarios()
    {
        return $this->hasMany(Usuario::class, 'grupo_id');
    }
}
