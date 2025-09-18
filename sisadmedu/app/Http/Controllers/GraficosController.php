<?php

namespace App\Http\Controllers;

use App\Models\Estudiante;
use App\Models\Usuario;
use App\Models\Docente;
use App\Models\Grado;
use Illuminate\Http\Request;

class GraficosController extends Controller
{
    public function index()
    {
        $totalEstudiantes = Estudiante::count();
        $totalUsuarios = Usuario::count();
        $totalDocentes = Docente::count();
        $totalGrados = Grado::count();

        return view('dashboard', compact(
            'totalEstudiantes',
            'totalUsuarios',
            'totalDocentes',
            'totalGrados'
        ));
    }
}
