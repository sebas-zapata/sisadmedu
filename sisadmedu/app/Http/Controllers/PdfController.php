<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Usuario;
use App\Models\Estudiante;


class PdfController extends Controller
{
    // Generar PDF de todos los usuarios
    public function usuarioPdf()
    {
        $usuarios = Usuario::all();
        $pdf = Pdf::loadView('pdf.usuarios', compact('usuarios'))->setPaper('a4', 'landscape');
        return $pdf->download('usuarios.pdf');
    }

    public function constancia($id)
    {
        $estudiante = Estudiante::with('grado')->findOrFail($id);

        $pdf = Pdf::loadView('pdf.constancia', compact('estudiante'))
            ->setPaper('A4', 'portrait');

        return $pdf->download('constancia_' . $estudiante->primer_apellido_estudiante .'_' . $estudiante->primer_nombre_estudiante . '.pdf');
    }
}
