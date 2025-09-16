<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Usuario;


class PdfController extends Controller
{
    // Generar PDF de todos los usuarios
    public function usuarioPdf(){
        $usuarios = Usuario::all();
        $pdf = Pdf::loadView('pdf.usuarios', compact('usuarios'))->setPaper('a4', 'landscape');
        return $pdf->download('usuarios.pdf');
    }
}
