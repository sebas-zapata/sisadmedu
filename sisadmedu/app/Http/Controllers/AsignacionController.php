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
        $request->validate([
            'docente_id' => 'required|exists:docentes,id',
            'materia_id' => 'required|exists:materias,id',
            'grado_id'   => 'required|exists:grados,id',
            'anio_lectivo' => 'nullable|string|max:20',
        ]);

        $exists = Asignacion::where('docente_id', $request->docente_id)
            ->where('materia_id', $request->materia_id)
            ->where('grado_id', $request->grado_id)
            ->where(function ($q) use ($request) {
                if ($request->filled('anio_lectivo')) {
                    $q->where('anio_lectivo', $request->anio_lectivo);
                } else {
                    $q->whereNull('anio_lectivo');
                }
            })
            ->exists();

        if ($exists) {
            return back()->withInput()->withErrors(['error' => 'Ya existe esa asignación para ese docente, materia y grado (mismo año lectivo).']);
        }

        DB::beginTransaction();
        try {
            Asignacion::create([
                'docente_id' => $request->docente_id,
                'materia_id' => $request->materia_id,
                'grado_id'   => $request->grado_id,
                'anio_lectivo' => $request->anio_lectivo,
            ]);
            DB::commit();

            return redirect()->route('asignaciones.index')->with('success', 'Asignación creada correctamente.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->withErrors(['error' => 'Error al crear asignación: ' . $e->getMessage()]);
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

        $request->validate([
            'docente_id' => 'required|exists:docentes,id',
            'materia_id' => 'required|exists:materias,id',
            'grado_id'   => 'required|exists:grados,id',
            'anio_lectivo' => 'nullable|string|max:20',
        ]);

        $exists = Asignacion::where('docente_id', $request->docente_id)
            ->where('materia_id', $request->materia_id)
            ->where('grado_id', $request->grado_id)
            ->where(function ($q) use ($request) {
                if ($request->filled('anio_lectivo')) {
                    $q->where('anio_lectivo', $request->anio_lectivo);
                } else {
                    $q->whereNull('anio_lectivo');
                }
            })
            ->where('id', '!=', $asignacion->id)
            ->exists();

        if ($exists) {
            return back()->withInput()->withErrors(['error' => 'Ya existe otra asignación con esos mismos valores.']);
        }

        DB::beginTransaction();
        try {
            $asignacion->update([
                'docente_id' => $request->docente_id,
                'materia_id' => $request->materia_id,
                'grado_id'   => $request->grado_id,
                'anio_lectivo' => $request->anio_lectivo,
            ]);
            DB::commit();

            return redirect()->route('asignaciones.index')->with('success', 'Asignación actualizada correctamente.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->withErrors(['error' => 'Error al actualizar asignación: ' . $e->getMessage()]);
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
