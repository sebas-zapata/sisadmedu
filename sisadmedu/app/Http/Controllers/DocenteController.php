<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Docente;
use App\Models\Materia;
use App\Models\TipoDocumento;
use App\Models\Usuario;
use App\Models\Rol;
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
            'documento' => 'required|string|max:255|unique:usuarios,documento',
            'primer_nombre' => 'required|string|max:255',
            'segundo_nombre' => 'nullable|string|max:255',
            'primer_apellido' => 'required|string|max:255',
            'segundo_apellido' => 'nullable|string|max:255',
            'correo_electronico' => 'required|string|email|max:255|unique:usuarios,correo_electronico',
            'celular' => 'required|string|max:20|unique:usuarios,celular', // validación de celular
            'id_materia' => 'required|exists:materias,id',
            'id_tipo_documento' => 'required|exists:tipos_documento,id',
        ]);

        DB::beginTransaction();

        try {
            // obtener id del rol docente (evita usar números mágicos)
            $rolDocente = Rol::where('nombre', 'Docente')->first();
            $rolId = $rolDocente ? $rolDocente->id : 8; // fallback si no existe

            // 1️⃣ Crear usuario (documento y celular se guardan en usuarios)
            $usuario = Usuario::create([
                'documento' => $request->documento,
                'celular' => $request->celular, // nuevo campo
                'nombres' => trim($request->primer_nombre . ' ' . $request->segundo_nombre),
                'apellidos' => trim($request->primer_apellido . ' ' . $request->segundo_apellido),
                'correo_electronico' => $request->correo_electronico,
                'contrasena' => Hash::make($request->documento), // contraseña inicial = documento
                'rol_id' => $rolId,
                'tipo_documento_id' => $request->id_tipo_documento,
            ]);

            // 2️⃣ Crear docente y vincular usuario (sin 'documento' ni 'celular' en docentes)
            Docente::create([
                'usuario_id' => $usuario->id,
                'id_tipo_documento' => $request->id_tipo_documento,
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
            // devuelve con input para no perder lo escrito y muestra el error
            return back()->withInput()->withErrors(['error' => 'Error al crear docente: ' . $e->getMessage()]);
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
            'documento' => 'required|string|max:255|unique:usuarios,documento,' . $docente->usuario->id,
            'primer_nombre' => 'required|string|max:255',
            'segundo_nombre' => 'nullable|string|max:255',
            'primer_apellido' => 'required|string|max:255',
            'segundo_apellido' => 'nullable|string|max:255',
            'correo_electronico' => 'required|string|email|max:255|unique:usuarios,correo_electronico,' . $docente->usuario->id,
            'celular' => 'required|string|max:20|unique:usuarios,celular,' . $docente->usuario->id, // 👈 validación de celular
            'id_materia' => 'required|exists:materias,id',
            'id_tipo_documento' => 'required|exists:tipos_documento,id',
        ]);

        DB::beginTransaction();

        try {
            // 1 Actualizar docente ( ya no incluye documento ni celular)
            $docente->update([
                'id_tipo_documento' => $request->id_tipo_documento,
                'primer_nombre' => $request->primer_nombre,
                'segundo_nombre' => $request->segundo_nombre,
                'primer_apellido' => $request->primer_apellido,
                'segundo_apellido' => $request->segundo_apellido,
                'id_materia' => $request->id_materia,
            ]);

            //  Actualizar usuario vinculado (incluye documento y celular)
            $docente->usuario->update([
                'documento' => $request->documento,
                'celular' => $request->celular, // nuevo campo
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
