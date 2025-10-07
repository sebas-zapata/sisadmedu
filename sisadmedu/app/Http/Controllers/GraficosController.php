<?php

namespace App\Http\Controllers;

use App\Models\Estudiante;
use App\Models\Usuario;
use App\Models\Docente;
use App\Models\Grado;
use App\Models\Horario;
use App\Models\Materia;
use App\Models\Asignacion;
use Illuminate\Http\Request;

class GraficosController extends Controller
{
    public function index()
    {
        $totalEstudiantes = Estudiante::count();
        $totalUsuarios = Usuario::count();
        $totalDocentes = Docente::count();
        $totalGrados = Grado::count();
        $totalHorarios = Horario::count();
        $totalMaterias = Materia::Count();
        $totalAsignaciones = Asignacion::count();


        return view('dashboard', compact(
            'totalEstudiantes',
            'totalUsuarios',
            'totalDocentes',
            'totalGrados',
            'totalHorarios',
            'totalMaterias',
            'totalAsignaciones'
        ));
    }
}
