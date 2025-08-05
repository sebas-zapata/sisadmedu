<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Docente;
use App\Models\Materia;
use App\Models\TipoDocumento;

class DocenteController extends Controller
{
    // Método para mostrar la lista de docentes
    // Obtiene todos los docentes con sus materias asociadas
    // Retorna la vista 'docentes.index' con los docentes
    // compactados en una variable
    public function index()
    {
        $docentes = Docente::with('materia')->get();
        return view('docentes.index', compact('docentes'));
    }

    // Método para mostrar el formulario de creación de un nuevo docente
    public function create()
    {
        $materias = Materia::all();
        return view('docentes.create', compact('materias'));
    }

    // Método para almacenar un nuevo docente en la base de datos
    // Valida los datos del formulario de creación
    // Crea un nuevo docente con los datos validados
    // Asocia el docente con la materia seleccionada
    // Redirige a la lista de docentes con un mensaje de éxito
    public function store(Request $request)
    {
        $request->validate([
            'codigo_docente' => 'required|string|max:255|unique:docentes',
            'primer_nombre' => 'required|string|max:255',
            'segundo_nombre' => 'nullable|string|max:255',
            'primer_apellido' => 'required|string|max:255',
            'segundo_apellido' => 'nullable|string|max:255',
            'correo_electronico' => 'required|string|email|max:255|unique:docentes',
            'id_materia' => 'required|exists:materias,id',
            'id_tipo_documento' => 'required|exists:tipos_documento,id',
        ],
        // Validaciones personalizadas para los mensajes de error
        [
            'codigo_docente.required' => 'El campo código del docente es obligatorio.',
            'codigo_docente.unique' => 'El código del docente ya está registrado.',
            'documento.unique' => 'El documento ya está registrado.',
            'documento.required' => 'El campo documento es obligatorio.',
            'documento.max' => 'El documento no puede tener más de 255 caracteres.',
            'primer_nombre.required' => 'El campo primer nombre es obligatorio.',
            'primer_nombre.max' => 'El primer nombre no puede tener más de 255 caracteres.',
            'segundo_nombre.max' => 'El segundo nombre no puede tener más de 255 caracteres.',
            'primer_apellido.required' => 'El campo primer apellido es obligatorio.',
            'primer_apellido.max' => 'El primer apellido no puede tener más de 255 caracteres.',
            'segundo_apellido.max' => 'El segundo apellido no puede tener más de 255 caracteres.',
            'correo_electronico.required' => 'El campo correo electrónico es obligatorio.',
            'correo_electronico.email' => 'El formato del correo electrónico es inválido.',
            'correo_electronico.unique' => 'El correo electrónico ya está registrado.',
            'id_materia.required' => 'Debe seleccionar una materia.',
            'id_tipo_documento.required' => 'Debe seleccionar un tipo de documento.',
        ]);

        $docente = Docente::create($request->all());

        return redirect()->route('docentes.index')->with('success', 'Docente creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $docente = Docente::with(['materia', 'tipoDocumento'])->findOrFail($id);
        return view('docentes.show', compact('docente'));
    }

    // Método para mostrar el formulario de edición de un docente
    // Obtiene el docente por su ID y todas las materias disponibles
    // Retorna la vista 'docentes.edit' con el docente y las materias
    // compactados en variables
    public function edit($id)
    {
        $docente = Docente::with(['materia', 'tipoDocumento'])->findOrFail($id);
        $materias = Materia::all();
        $documentos = TipoDocumento::all();
        return view('docentes.edit', compact('docente', 'materias', 'documentos'));
    }



    // Método para actualizar un docente existente
    // Valida los datos del formulario de edición
    // Busca el docente por su ID y actualiza sus datos
    // Redirige a la lista de docentes con un mensaje de éxito
    public function update(Request $request, $id)
    {
        $request->validate([
            'codigo_docente' => 'required|string|max:255|unique:docentes,codigo_docente,' . $id,
            'primer_nombre' => 'required|string|max:255',
            'segundo_nombre' => 'nullable|string|max:255',
            'primer_apellido' => 'required|string|max:255',
            'segundo_apellido' => 'nullable|string|max:255',
            'correo_electronico' => 'required|string|email|max:255|unique:docentes,correo_electronico,' . $id,
            'id_materia' => 'required|exists:materias,id',
            'id_tipo_documento' => 'required|exists:tipos_documento,id', // Validar que el tipo de documento exista
        ]);

        $docente = Docente::findOrFail($id);
        $docente->update($request->all());

        return redirect()->route('docentes.index')->with('success', 'Docente actualizado exitosamente.');
    }

    // Método para eliminar un docente
    // Busca el docente por su ID y lo elimina de la base de datos
    // Redirige a la lista de docentes con un mensaje de éxito
    public function destroy(string $id)
    {
        $docente = Docente::findOrFail($id);
        $docente->delete();

        return redirect()->route('docentes.index')->with('success', 'Docente eliminado exitosamente.');
    }
}
