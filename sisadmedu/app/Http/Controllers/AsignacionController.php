<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Asignacion;
use App\Models\Docente;
use App\Models\Materia;
use App\Models\Grado;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class AsignacionController extends Controller
{
    public function __construct()
    {
        // Middleware para restringir acceso según el rol
        $this->middleware(function ($request, $next) {
            if (in_array(Auth::user()->rol->nombre, ['Docente', 'Estudiante', 'Acudiente'])) {
                return redirect()->route('dashboard')
                    ->with('error', 'No tienes permisos para acceder a las asignaciones.');
            }
            return $next($request);
        });
    }

    public function index()
    {
        $asignaciones = Asignacion::with(['docente.usuario', 'materia', 'grado'])->get();
        return view('asignaciones.index', compact('asignaciones'));
    }

    public function create()
    {
        $docentes = Docente::with('usuario')->get();
        $materias = Materia::all();
        $grados = Grado::all();

        return view('asignaciones.create', compact('docentes', 'materias', 'grados'));
    }

    public function store(Request $request)
    {
        // Validaciones base con mensajes personalizados
        $request->validate([
            'docente_id' => 'required|exists:docentes,id',
            'materia_id' => 'required|exists:materias,id',
            'grado_id'   => 'required|exists:grados,id',
        ], [
            'docente_id.required' => 'Debes seleccionar un docente.',
            'docente_id.exists'   => 'El docente seleccionado no existe en el sistema.',

            'materia_id.required' => 'Debes seleccionar una materia.',
            'materia_id.exists'   => 'La materia seleccionada no existe en el sistema.',

            'grado_id.required'   => 'Debes seleccionar un grado.',
            'grado_id.exists'     => 'El grado seleccionado no existe en el sistema.',
        ]);

        // Año lectivo automático
        $anioActual = date('Y');

        // Validar que no exista la misma combinación (docente + materia + grado + año)
        $asignacionExistente = Asignacion::where('docente_id', $request->docente_id)
            ->where('materia_id', $request->materia_id)
            ->where('grado_id', $request->grado_id)
            ->where('anio_lectivo', $anioActual)
            ->exists();

        if ($asignacionExistente) {
            return back()
                ->withInput()
                ->withErrors([
                    'error' => 'Ya existe una asignación para este docente, materia y grado en el año lectivo actual.'
                ]);
        }

        // Validar que la misma materia y grado no estén ya asignados a otro docente en el mismo año
        $conflicto = Asignacion::where('materia_id', $request->materia_id)
            ->where('grado_id', $request->grado_id)
            ->where('anio_lectivo', $anioActual)
            ->where('docente_id', '!=', $request->docente_id)
            ->exists();

        if ($conflicto) {
            return back()
                ->withInput()
                ->withErrors([
                    'error' => 'Esa materia ya está asignada a otro docente en este grado y año lectivo.'
                ]);
        }

        // Crear asignación dentro de una transacción
        DB::beginTransaction();
        try {
            Asignacion::create([
                'docente_id'   => $request->docente_id,
                'materia_id'   => $request->materia_id,
                'grado_id'     => $request->grado_id,
                'anio_lectivo' => $anioActual,
            ]);

            DB::commit();

            return redirect()
                ->route('asignaciones.index')
                ->with('success', 'Asignación creada correctamente.');
        } catch (\Exception $e) {
            DB::rollBack();

            return back()
                ->withInput()
                ->withErrors([
                    'error' => 'Error al crear la asignación: ' . $e->getMessage()
                ]);
        }
    }



    public function show($id)
    {
        $asignacion = Asignacion::with(['docente.usuario', 'materia', 'grado'])->findOrFail($id);
        return view('asignaciones.show', compact('asignacion'));
    }

    public function edit($id)
    {
        $asignacion = Asignacion::findOrFail($id);
        $docentes = Docente::with('usuario')->get();
        $materias = Materia::all();
        $grados = Grado::all();

        return view('asignaciones.edit', compact('asignacion', 'docentes', 'materias', 'grados'));
    }

    public function update(Request $request, $id)
    {
        $asignacion = Asignacion::findOrFail($id);

        // Validaciones con mensajes personalizados
        $request->validate([
            'docente_id' => 'required|exists:docentes,id',
            'materia_id' => 'required|exists:materias,id',
            'grado_id'   => 'required|exists:grados,id',
        ], [
            'docente_id.required' => 'Debes seleccionar un docente.',
            'docente_id.exists'   => 'El docente seleccionado no existe en el sistema.',

            'materia_id.required' => 'Debes seleccionar una materia.',
            'materia_id.exists'   => 'La materia seleccionada no existe en el sistema.',

            'grado_id.required'   => 'Debes seleccionar un grado.',
            'grado_id.exists'     => 'El grado seleccionado no existe en el sistema.',
        ]);

        // Año lectivo automático
        $anioActual = date('Y');

        // Validar duplicado: misma combinación docente + materia + grado + año (sin incluir la actual)
        $asignacionDuplicada = Asignacion::where('docente_id', $request->docente_id)
            ->where('materia_id', $request->materia_id)
            ->where('grado_id', $request->grado_id)
            ->where('anio_lectivo', $anioActual)
            ->where('id', '!=', $asignacion->id)
            ->exists();

        if ($asignacionDuplicada) {
            return back()
                ->withInput()
                ->withErrors([
                    'error' => 'Ya existe otra asignación con el mismo docente, materia, grado y año lectivo.'
                ]);
        }

        // Validar conflicto: otro docente ya tiene esa materia en el mismo grado y año
        $conflicto = Asignacion::where('materia_id', $request->materia_id)
            ->where('grado_id', $request->grado_id)
            ->where('anio_lectivo', $anioActual)
            ->where('docente_id', '!=', $request->docente_id)
            ->exists();

        if ($conflicto) {
            return back()
                ->withInput()
                ->withErrors([
                    'error' => 'Esa materia ya está asignada a otro docente en este grado y año lectivo.'
                ]);
        }

        // Transacción segura para actualizar los datos
        DB::beginTransaction();
        try {
            $asignacion->update([
                'docente_id'   => $request->docente_id,
                'materia_id'   => $request->materia_id,
                'grado_id'     => $request->grado_id,
                'anio_lectivo' => $anioActual,
            ]);

            DB::commit();

            return redirect()
                ->route('asignaciones.index')
                ->with('success', 'Asignación actualizada correctamente.');
        } catch (\Exception $e) {
            DB::rollBack();

            return back()
                ->withInput()
                ->withErrors([
                    'error' => 'Error al actualizar la asignación: ' . $e->getMessage()
                ]);
        }
    }



    public function destroy($id)
    {
        $asignacion = Asignacion::findOrFail($id);

        DB::beginTransaction();
        try {
            $asignacion->delete();
            DB::commit();
            return redirect()->route('asignaciones.index')->with('success', 'Asignación eliminada.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Error al eliminar asignación: ' . $e->getMessage()]);
        }
    }
}
