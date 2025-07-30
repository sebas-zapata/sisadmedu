<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Materia extends Model
{
    use HasFactory;

    protected $table = 'materias';
    protected $fillable = ['descripcion'];

    public function docentes()
    {
        return $this->hasMany(Docente::class, 'id_materia');
    }
}
