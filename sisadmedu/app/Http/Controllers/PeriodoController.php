<?php

// app/Http/Controllers/PeriodoController.php

namespace App\Http\Controllers;

use App\Models\Periodo;
use Illuminate\Http\Request;

class PeriodoController extends Controller
{
    // Mostrar lista de periodos
    public function index()
    {
        $periodos = Periodo::orderBy('numero_periodo')->get();
        return view('periodos.index', compact('periodos'));
    }

    // Cambiar estado de un periodo
    public function cambiarEstado($id)
    {
        $periodo = Periodo::findOrFail($id);

        // Alternar estado
        $periodo->activo = !$periodo->activo;
        $periodo->save();

        return back()->with('success', 'Estado del periodo actualizado correctamente.');
    }
}
