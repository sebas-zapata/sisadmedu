<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Docente;
use App\Models\Materia;
use App\Models\TipoDocumento;

class DocenteController extends Controller
{
    // Método para mostrar la lista de docentes
    public function index()
    {
        $docentes = Docente::with('materia')->get();
        return view('docentes.index', compact('docentes'));
    }

    // Método para mostrar el formulario de creación de un nuevo docente
    public function create()
    {
        $materias = Materia::all();
        $tipoDocumentos = TipoDocumento::all();
        return view('docentes.create', compact('materias', 'tipoDocumentos'));
    }

    // Método para almacenar un nuevo docente en la base de datos
    public function store(Request $request)
    {
        $request->validate([
            'documento' => 'required|string|max:255|unique:docentes',
            'primer_nombre' => 'required|string|max:255',
            'segundo_nombre' => 'nullable|string|max:255',
            'primer_apellido' => 'required|string|max:255',
            'segundo_apellido' => 'nullable|string|max:255',
            'correo_electronico' => 'required|string|email|max:255|unique:docentes',
            'id_materia' => 'required|exists:materias,id',
            'id_tipo_documento' => 'required|exists:tipos_documento,id',
        ],
        [
            'documento.unique' => 'El documento ya está registrado.',
            'documento.required' => 'El campo documento es obligatorio.',
            'primer_nombre.required' => 'El campo primer nombre es obligatorio.',
            'primer_apellido.required' => 'El campo primer apellido es obligatorio.',
            'correo_electronico.required' => 'El campo correo electrónico es obligatorio.',
            'correo_electronico.email' => 'El formato del correo electrónico es inválido.',
            'correo_electronico.unique' => 'El correo electrónico ya está registrado.',
            'id_materia.required' => 'Debe seleccionar una materia.',
            'id_tipo_documento.required' => 'Debe seleccionar un tipo de documento.',
        ]);

        Docente::create($request->all());

        return redirect()->route('docentes.index')->with('success', 'Docente creado exitosamente.');
    }

    // Método para mostrar un docente en detalle
    public function show(string $id)
    {
        $docente = Docente::with(['materia', 'tipoDocumento'])->findOrFail($id);
        return view('docentes.show', compact('docente'));
    }

    // Método para mostrar el formulario de edición de un docente
    public function edit($id)
    {
        $docente = Docente::with(['materia', 'tipoDocumento'])->findOrFail($id);
        $materias = Materia::all();
        $documentos = TipoDocumento::all();
        return view('docentes.edit', compact('docente', 'materias', 'documentos'));
    }

    // Método para actualizar un docente existente
    public function update(Request $request, $id)
    {
        $request->validate([
            'documento' => 'required|string|max:255|unique:docentes,documento,' . $id,
            'primer_nombre' => 'required|string|max:255',
            'segundo_nombre' => 'nullable|string|max:255',
            'primer_apellido' => 'required|string|max:255',
            'segundo_apellido' => 'nullable|string|max:255',
            'correo_electronico' => 'required|string|email|max:255|unique:docentes,correo_electronico,' . $id,
            'id_materia' => 'required|exists:materias,id',
            'id_tipo_documento' => 'required|exists:tipos_documento,id',
        ],
        [
            'documento.unique' => 'El documento ya está registrado.',
            'documento.required' => 'El campo documento es obligatorio.',
            'primer_nombre.required' => 'El campo primer nombre es obligatorio.',
            'primer_apellido.required' => 'El campo primer apellido es obligatorio.',
            'correo_electronico.required' => 'El campo correo electrónico es obligatorio.',
            'correo_electronico.email' => 'El formato del correo electrónico es inválido.',
            'correo_electronico.unique' => 'El correo electrónico ya está registrado.',
            'id_materia.required' => 'Debe seleccionar una materia.',
            'id_tipo_documento.required' => 'Debe seleccionar un tipo de documento.',
        ]);

        $docente = Docente::findOrFail($id);
        $docente->update($request->all());

        return redirect()->route('docentes.index')->with('success', 'Docente actualizado exitosamente.');
    }

    // Método para eliminar un docente
    public function destroy(string $id)
    {
        $docente = Docente::findOrFail($id);
        $docente->delete();

        return redirect()->route('docentes.index')->with('success', 'Docente eliminado exitosamente.');
    }
}
