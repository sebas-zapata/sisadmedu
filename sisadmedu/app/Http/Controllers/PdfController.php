<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Usuario;
use App\Models\Estudiante;
use App\Models\Asistencia;
use App\Models\Asignacion;
use Carbon\Carbon;
use Illuminate\Container\Attributes\Auth;
use App\Models\LoginUsuario;

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

        return $pdf->download('constancia_' . $estudiante->primer_apellido_estudiante . '_' . $estudiante->primer_nombre_estudiante . '.pdf');
    }

    public function consultarEstudiante()
    {
        return view('estudiantes.generar-certificado');
    }

    public function generarCertificado(Request $request)
    {
        // Validar entrada
        $request->validate([
            'matricula' => 'required|string|max:14',
        ], [
            'matricula.required' => 'La matrícula es obligatoria.',
        ]);

        // 1. Buscar estudiante por matrícula
        $estudiante = Estudiante::where('matricula', $request->matricula)->first();

        // Si NO existe
        if (!$estudiante) {
            return back()->withErrors([
                'matricula' => 'No existe un estudiante con este codigo de matrícula: ' . $request->matricula
            ]);
        }

        // 2. Generar PDF
        $pdf = Pdf::loadView('pdf.constancia', compact('estudiante'))
            ->setPaper('A4', 'portrait');

        // 3. Descargar PDF
        return $pdf->download(
            'constancia_' . $estudiante->primer_apellido_estudiante . '_' . $estudiante->primer_nombre_estudiante . '.pdf'
        );
    }

    public function generarReporteMensualPdf(Request $request, Asignacion $asignacion)
    {
        $mes = $request->input('mes', date('m'));
        $anio = $request->input('anio', date('Y'));

        if (!$mes || !$anio) {
            return redirect()->back()->with('error', 'Debe seleccionar mes y año antes de generar el PDF.');
        }

        $fechaInicio = Carbon::createFromDate($anio, $mes, 1)->startOfMonth();
        $fechaFin = $fechaInicio->copy()->endOfMonth();

        $asistencias = Asistencia::where('asignacion_id', $asignacion->id)
            ->whereBetween('fecha', [$fechaInicio, $fechaFin])
            ->get()
            ->groupBy('estudiante_id');

        $diasDelMes = range(1, $fechaFin->day);

        $pdf = Pdf::loadView('pdf.reporte_mensual_pdf', compact(
            'asignacion',
            'asistencias',
            'diasDelMes',
            'mes',
            'anio'
        ))->setPaper('a4', 'landscape');

        return $pdf->download("reporte_asistencias_{$asignacion->materia->descripcion}_{$mes}_{$anio}.pdf");
    }
}
