<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TipoDocumento extends Model
{
    use HasFactory;

    protected $table = 'tipos_documento';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'codigo',
        'descripcion',
    ];

    // Relación con el modelo de usuarios
    public function usuarios()
    {
        return $this->hasMany(Usuario::class, 'tipo_documento_id');
    }
}
