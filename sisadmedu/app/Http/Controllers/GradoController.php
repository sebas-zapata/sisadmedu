<?php

namespace App\Http\Controllers;

use App\Models\Grado;
use Illuminate\Http\Request;

class GradoController extends Controller
{
    // Mostrar todos los grados
    public function index()
    {
        $grados = Grado::paginate(3);
        return view('grados.index', compact('grados'));
    }

    // Mostrar el formulario para crear un nuevo grado
    public function create()
    {
        return view('grados.create');
    }

    // Almacenar un nuevo grado
    public function store(Request $request)
    {
        $request->validate([
            'nombre_grado' => 'required|string|max:255|unique:grados',
        ],
        // Validaciones personalizadas para los mensajes de error
        [
            'nombre_grado.required' => 'El campo nombre del grado es obligatorio.',
            'nombre_grado.unique' => 'El nombre del grado ya está registrado.',
        ]
    );

        Grado::create($request->all());

        return redirect()->route('grados.index')->with('success', 'Grado creado exitosamente.');
    }


    // Mostrar un grado específico
    public function show(Grado $grado)
    {
        return view('grados.show', compact('grado'));
    }


    // Mostrar el formulario para editar un grado
    public function edit(Grado $grado)
    {
        return view('grados.edit', compact('grado'));
    }


    // Actualizar un grado específico
    public function update(Request $request, Grado $grado)
    {
        $request->validate([
            'nombre_grado' => 'required|string|max:255|unique:grados,nombre_grado,' . $grado->id,
        ],
        // Validaciones personalizadas para los mensajes de error
        [
            'nombre_grado.required' => 'El campo nombre del grado es obligatorio.',
            'nombre_grado.unique' => 'El nombre del grado ya está registrado.',
        ]
    );

        $grado->update($request->all());

        return redirect()->route('grados.index')->with('success', 'Grado actualizado exitosamente.');
    }


    // Eliminar un grado específico
    public function destroy(Grado $grado)
    {
        $grado->delete();

        return redirect()->route('grados.index')->with('success', 'Grado eliminado exitosamente.');
    }
}
