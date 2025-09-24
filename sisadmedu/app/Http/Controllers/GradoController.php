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
        $request->validate(
            [
                'nivel_grado' => 'required|integer|min:1|max:11',
                'grupo_grado' => 'required|integer|min:1|max:5',
            ],
            [
                'nivel_grado.required' => 'Debe seleccionar un nivel.',
                'nivel_grado.integer'  => 'El nivel debe ser un número.',
                'nivel_grado.min'      => 'El nivel no puede ser menor que 1.',
                'nivel_grado.max'      => 'El nivel no puede ser mayor que 11.',

                'grupo_grado.required' => 'Debe seleccionar un grupo.',
                'grupo_grado.integer'  => 'El grupo debe ser un número.',
                'grupo_grado.min'      => 'El grupo no puede ser menor que 1.',
                'grupo_grado.max'      => 'El grupo no puede ser mayor que 5.',
            ]
        );

        // Verificar si ya existe un grado con el mismo nivel y grupo
        $existe = Grado::where('nivel_grado', $request->nivel_grado)
            ->where('grupo_grado', $request->grupo_grado)
            ->exists();

        if ($existe) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['grupo_grado' => 'Ese grado ya está registrado.']);
        }

        // Crear el nuevo grado
        Grado::create([
            'nivel_grado' => $request->nivel_grado,
            'grupo_grado' => $request->grupo_grado,
        ]);

        return redirect()->route('grados.index')
            ->with('success', 'Grado creado exitosamente.');
    }


    // Mostrar un grado específico
    public function show(Grado $grado)
    {
        // Cargar la relación estudiantes
        $grado->load('estudiantes');
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
        $request->validate(
            [
                'nivel_grado' => 'required|integer|min:1|max:11',
                'grupo_grado' => 'required|integer|min:1|max:5',
            ],
            [
                'nivel_grado.required' => 'Debe seleccionar un nivel.',
                'nivel_grado.integer'  => 'El nivel debe ser un número.',
                'nivel_grado.min'      => 'El nivel no puede ser menor que 1.',
                'nivel_grado.max'      => 'El nivel no puede ser mayor que 11.',

                'grupo_grado.required' => 'Debe seleccionar un grupo.',
                'grupo_grado.integer'  => 'El grupo debe ser un número.',
                'grupo_grado.min'      => 'El grupo no puede ser menor que 1.',
                'grupo_grado.max'      => 'El grupo no puede ser mayor que 5.',
            ]
        );

        // Verificar si ya existe un grado con el mismo nivel y grupo (excepto el actual)
        $existe = Grado::where('nivel_grado', $request->nivel_grado)
            ->where('grupo_grado', $request->grupo_grado)
            ->where('id', '!=', $grado->id)
            ->exists();

        if ($existe) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['grupo_grado' => 'Ese grado ya está registrado.']);
        }

        // Actualizar el registro
        $grado->update([
            'nivel_grado' => $request->nivel_grado,
            'grupo_grado' => $request->grupo_grado,
        ]);

        return redirect()->route('grados.index')
            ->with('success', 'Grado actualizado exitosamente.');
    }



    // Eliminar un grado específico
    public function destroy(Grado $grado)
    {
        $grado->delete();

        return redirect()->route('grados.index')->with('success', 'Grado eliminado exitosamente.');
    }
}
