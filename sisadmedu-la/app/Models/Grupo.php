<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Grupo extends Model
{
    use HasFactory;

    protected $table = 'grupos';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'nombre',
    ];
}
