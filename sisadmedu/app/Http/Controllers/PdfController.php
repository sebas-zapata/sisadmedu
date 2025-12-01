<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Usuario;
use App\Models\Estudiante;
use App\Models\Asistencia;
use App\Models\Asignacion;
use Carbon\Carbon;


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
            'documento' => 'required|string',
        ]);

        // 1. Buscar usuario por documento
        $usuario = Usuario::where('documento', $request->documento)->first();

        if (!$usuario) {
            return back()
            ->with('error', 'No existe un usuario con ese documento.');
        }

        // 2. Buscar el estudiante relacionado a ese usuario
        $estudiante = Estudiante::where('usuario_id', $usuario->id)->first();


        // 3. Generar PDF
        $pdf = Pdf::loadView('pdf.constancia', compact('estudiante'))
            ->setPaper('A4', 'portrait');

        // Alert
        return redirect()->route('pdf.consultar')->with('success', 'Certificado generado correctamente. Revisa tu carpeta de descargas.');

        return $pdf->download(
            'constancia_' . $estudiante->primer_apellido_estudiante . '_' . $estudiante->primer_nombre_estudiante . '.pdf'
        );
    }




    public function generarReporteMensualPdf(Request $request, Asignacion $asignacion)
    {
        $mes = $request->input('mes');
        $anio = $request->input('anio');

        if (!$mes || !$anio) {
            return redirect()->back()->with('error', 'Debe seleccionar mes y año antes de generar el PDF.');
        }

        $fechaInicio = Carbon::createFromDate($anio, $mes, 1);
        $fechaFin = $fechaInicio->copy()->endOfMonth();

        $asistencias = Asistencia::where('asignacion_id', $asignacion->id)
            ->whereBetween('fecha', [$fechaInicio, $fechaFin])
            ->get()
            ->groupBy('estudiante_id');

        $diasDelMes = range(1, $fechaFin->day);

        $pdf = Pdf::loadView('pdf.reporte_mensual_pdf', compact('asignacion', 'asistencias', 'diasDelMes', 'mes', 'anio'))
            ->setPaper('a4', 'landscape');

        return $pdf->download("reporte_asistencias_{$asignacion->materia->descripcion}_{$mes}_{$anio}.pdf");
    }
}
