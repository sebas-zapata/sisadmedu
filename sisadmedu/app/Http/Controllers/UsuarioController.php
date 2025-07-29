<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use App\Models\Rol;
use App\Models\TipoDocumento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    // Método para mostrar la lista de usuarios
    // Este método obtiene todos los usuarios con sus roles y tipos de documento
    // y retorna la vista 'usuarios.index' con los datos
    // de los usuarios para ser mostrados en una tabla
    // Se utiliza el método 'with' para cargar las relaciones de rol y tipoDocumento
    public function index()
    {
        $usuarios = Usuario::with(['rol', 'tipoDocumento'])->get();
        return view('usuarios.index', compact('usuarios'));
    }

    
    public function create()
    {
        $roles = Rol::all();
        $tiposDocumento = TipoDocumento::all();
        return view('usuarios.create', compact('roles', 'tiposDocumento'));
    }

    // Método para almacenar un nuevo usuario
    // Este método valida los datos del formulario de creación de usuario
    // y crea un nuevo usuario en la base de datos
    // Se utiliza el método 'Hash::make' para encriptar la contraseña del usuario
    // Envia mensaje de éxito al redirigir a la lista de usuarios
    public function store(Request $request)
    {
        $request->validate([
            'documento' => 'required|unique:usuarios',
            'nombres' => 'required',
            'apellidos' => 'required',
            'correo_electronico' => 'required|email|unique:usuarios',
            'telefono' => 'required|unique:usuarios',
            'contrasena' => 'required|min:6',
            'rol_id' => 'required|exists:roles,id',
            'tipo_documento_id' => 'required|exists:tipos_documento,id',
        ]);

        $datos = $request->all();
        $datos['contrasena'] = Hash::make($request->contrasena);

        Usuario::create($datos);

        return redirect()->route('usuarios.index')->with('success', 'Usuario creado correctamente.');
    }

    // Método para mostrar un usuario específico
    // Este método busca el usuario por su ID y retorna la vista 'usuarios.show'
    // con los datos del usuario, incluyendo su rol y tipo de documento
    // Se utiliza el método 'with' para cargar las relaciones de rol y tipoDocumento
    public function show($id)
    {
        $usuario = Usuario::with(['rol', 'tipoDocumento'])->findOrFail($id);
        return view('usuarios.show', compact('usuario'));
    }

    // Método para mostrar el formulario de edición de un usuario
    // Este método busca el usuario por su ID y retorna la vista 'usuarios.edit'
    // con los datos del usuario y las listas de roles y tipos de documento
    // para que puedan ser seleccionados en el formulario de edición
    // Se utiliza el método 'findOrFail' para obtener el usuario o lanzar una excepción
    // si no se encuentra
    public function edit($id)
    {
        $usuario = Usuario::findOrFail($id);
        $roles = Rol::all();
        $tiposDocumento = TipoDocumento::all();
        return view('usuarios.edit', compact('usuario', 'roles', 'tiposDocumento'));
    }

    // Método para actualizar un usuario
    // Este método busca el usuario por su ID, valida los datos del formulario
    // y actualiza los datos del usuario en la base de datos
    // Si la contraseña no se modifica, se mantiene la contraseña actual
    // Envia mensaje de éxito al redirigir a la lista de usuarios
    public function update(Request $request, $id)
    {
        $usuario = Usuario::findOrFail($id);

        $request->validate([
            'documento' => 'required|unique:usuarios,documento,' . $id,
            'nombres' => 'required',
            'apellidos' => 'required',
            'correo_electronico' => 'required|email|unique:usuarios,correo_electronico,' . $id,
            'telefono' => 'required|unique:usuarios,telefono,' . $id,
            'rol_id' => 'required|exists:roles,id',
            'tipo_documento_id' => 'required|exists:tipos_documento,id',
        ]);

        $datos = $request->all();

        if ($request->filled('contrasena')) {
            $datos['contrasena'] = Hash::make($request->contrasena);
        } else {
            $datos['contrasena'] = $usuario->contrasena;
        }

        $usuario->update($datos);

        return redirect()->route('usuarios.index')->with('success', 'Usuario actualizado correctamente.');
    }

    // Método para eliminar un usuario
    // Este método busca el usuario por su ID y lo elimina de la base de datos
    // Envia mensaje de éxito al redirigir a la lista de usuarios
    public function destroy($id)
    {
        $usuario = Usuario::findOrFail($id);
        $usuario->delete();

        return redirect()->route('usuarios.index')->with('success', 'Usuario eliminado correctamente.');
    }
}
