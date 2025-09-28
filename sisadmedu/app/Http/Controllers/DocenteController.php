<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Docente;
use App\Models\Materia;
use App\Models\TipoDocumento;
use App\Models\Usuario;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DocenteController extends Controller
{
    public function index()
    {
        $docentes = Docente::with(['materia', 'usuario'])->get();
        return view('docentes.index', compact('docentes'));
    }

    public function create()
    {
        $materias = Materia::all();
        $tipoDocumentos = TipoDocumento::all();
        return view('docentes.create', compact('materias', 'tipoDocumentos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'documento' => 'required|string|max:255|unique:docentes,documento|unique:usuarios,documento',
            'primer_nombre' => 'required|string|max:255',
            'segundo_nombre' => 'nullable|string|max:255',
            'primer_apellido' => 'required|string|max:255',
            'segundo_apellido' => 'nullable|string|max:255',
            'correo_electronico' => 'required|string|email|max:255|unique:usuarios,correo_electronico',
            'id_materia' => 'required|exists:materias,id',
            'id_tipo_documento' => 'required|exists:tipos_documento,id',
        ]);

        DB::beginTransaction();

        try {
            // 1️⃣ Crear usuario
            $usuario = Usuario::create([
                'documento' => $request->documento,
                'nombres' => trim($request->primer_nombre . ' ' . $request->segundo_nombre),
                'apellidos' => trim($request->primer_apellido . ' ' . $request->segundo_apellido),
                'correo_electronico' => $request->correo_electronico,
                'contrasena' => Hash::make($request->documento), // contraseña inicial = documento
                'rol_id' => 8, // rol docente
                'tipo_documento_id' => $request->id_tipo_documento,
            ]);

            // 2️⃣ Crear docente y vincular usuario
            Docente::create([
                'usuario_id' => $usuario->id,
                'id_tipo_documento' => $request->id_tipo_documento,
                'documento' => $request->documento,
                'primer_nombre' => $request->primer_nombre,
                'segundo_nombre' => $request->segundo_nombre,
                'primer_apellido' => $request->primer_apellido,
                'segundo_apellido' => $request->segundo_apellido,
                'id_materia' => $request->id_materia,
            ]);

            DB::commit();

            return redirect()->route('docentes.index')->with('success', 'Docente creado y usuario vinculado exitosamente.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Error al crear docente: ' . $e->getMessage()]);
        }
    }

    public function show(string $id)
    {
        $docente = Docente::with(['materia', 'tipoDocumento', 'usuario'])->findOrFail($id);
        return view('docentes.show', compact('docente'));
    }

    public function edit($id)
    {
        $docente = Docente::with(['materia', 'tipoDocumento', 'usuario'])->findOrFail($id);
        $materias = Materia::all();
        $documentos = TipoDocumento::all();
        return view('docentes.edit', compact('docente', 'materias', 'documentos'));
    }

    public function update(Request $request, $id)
    {
        $docente = Docente::with('usuario')->findOrFail($id);

        $request->validate([
            'documento' => 'required|string|max:255|unique:docentes,documento,' . $docente->id
                . '|unique:usuarios,documento,' . $docente->usuario_id,
            'primer_nombre' => 'required|string|max:255',
            'segundo_nombre' => 'nullable|string|max:255',
            'primer_apellido' => 'required|string|max:255',
            'segundo_apellido' => 'nullable|string|max:255',
            'correo_electronico' => 'required|string|email|max:255|unique:usuarios,correo_electronico,' . $docente->usuario_id,
            'id_materia' => 'required|exists:materias,id',
            'id_tipo_documento' => 'required|exists:tipos_documento,id',
        ]);

        DB::beginTransaction();

        try {
            // 1️⃣ Actualizar docente
            $docente->update([
                'id_tipo_documento' => $request->id_tipo_documento,
                'documento' => $request->documento,
                'primer_nombre' => $request->primer_nombre,
                'segundo_nombre' => $request->segundo_nombre,
                'primer_apellido' => $request->primer_apellido,
                'segundo_apellido' => $request->segundo_apellido,
                'id_materia' => $request->id_materia,
            ]);

            // 2️⃣ Actualizar usuario vinculado
            $docente->usuario->update([
                'documento' => $request->documento,
                'nombres' => trim($request->primer_nombre . ' ' . $request->segundo_nombre),
                'apellidos' => trim($request->primer_apellido . ' ' . $request->segundo_apellido),
                'correo_electronico' => $request->correo_electronico,
                'tipo_documento_id' => $request->id_tipo_documento,
            ]);

            DB::commit();

            return redirect()->route('docentes.index')->with('success', 'Docente y usuario actualizados exitosamente.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Error al actualizar docente: ' . $e->getMessage()]);
        }
    }

    public function destroy(string $id)
    {
        $docente = Docente::with('usuario')->findOrFail($id);

        DB::transaction(function () use ($docente) {
            $docente->usuario()->delete(); // eliminar usuario vinculado
            $docente->delete();
        });

        return redirect()->route('docentes.index')->with('success', 'Docente y usuario eliminados exitosamente.');
    }
}
