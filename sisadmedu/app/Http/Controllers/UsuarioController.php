<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use App\Models\LoginUsuario;
use App\Models\Rol;
use App\Models\TipoDocumento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

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

    // Método para mostrar el formulario de creación de un nuevo usuario
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
        // 1️⃣ Validar los datos del formulario
        $request->validate(
            [
                'documento' => 'required|unique:usuarios',
                'nombres' => 'required',
                'apellidos' => 'required',
                'correo_electronico' => 'required|email|unique:usuarios',
                'telefono' => 'required|unique:usuarios',
                'rol_id' => 'required|exists:roles,id',
                'tipo_documento_id' => 'required|exists:tipos_documento,id',
            ],
            [
                'documento.required' => 'El campo documento es obligatorio.',
                'documento.unique' => 'El documento ya está registrado.',
                'nombres.required' => 'El campo nombres es obligatorio.',
                'apellidos.required' => 'El campo apellidos es obligatorio.',
                'correo_electronico.required' => 'El campo correo electrónico es obligatorio.',
                'correo_electronico.email' => 'El campo correo electrónico debe ser una dirección de correo válida.',
                'correo_electronico.unique' => 'El correo electrónico ya está registrado.',
                'telefono.unique' => 'El teléfono ya está registrado.',
                'telefono.required' => 'El campo teléfono es obligatorio.',
                'rol_id.required' => 'Debe seleccionar un rol.',
                'tipo_documento_id.required' => 'Debe seleccionar un tipo de documento.',
            ]
        );

        // Obtener todos los datos del formulario
        $datos = $request->all();

        // Asignar el documento como contraseña por defecto
        // Se guarda hasheada para seguridad
        $datos['contrasena'] = Hash::make($request->documento);
        // Crear el usuario en la base de datos
        Usuario::create($datos);

        // Redirigir con mensaje indicando que la contraseña inicial es el documento
        return redirect()->route('usuarios.index')
            ->with('success', "Usuario creado correctamente. La contraseña inicial es el documento del usuario.");
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

        $request->validate(
            [
                'documento' => 'required|string|max:20|unique:usuarios,documento,' . $usuario->id,
                'nombres' => 'required|string|max:100',
                'apellidos' => 'required|string|max:100',
                'correo_electronico' => 'required|email|unique:usuarios,correo_electronico,' . $usuario->id,
                'telefono' => 'nullable|string|max:20',
                'rol_id' => 'required|exists:roles,id',
                'tipo_documento_id' => 'required|exists:tipos_documento,id',

                // Contraseña solo si la quiere cambiar
                'contrasena' => 'nullable|min:6|confirmed',
            ]
            // Validaciones personalizadas para los mensajes de error
            ,
            [
                'documento.required' => 'El campo documento es obligatorio.',
                'documento.unique' => 'El documento ya está registrado.',
                'nombres.required' => 'El campo nombres es obligatorio.',
                'apellidos.required' => 'El campo apellidos es obligatorio.',
                'correo_electronico.required' => 'El campo correo electrónico es obligatorio.',
                'correo_electronico.email' => 'El campo correo electrónico debe ser una dirección de correo válida.',
                'correo_electronico.unique' => 'El correo electrónico ya está registrado.',
                'telefono.unique' => 'El teléfono ya está registrado.',
                'telefono.required' => 'El campo teléfono es obligatorio.',
                'contrasena.min' => 'La contraseña debe tener al menos 6 caracteres.',
                'contrasena.confirmed' => 'La confirmación de la contraseña no coincide.',
                'rol_id.required' => 'Debe seleccionar un rol.',
                'tipo_documento_id.required' => 'Debe seleccionar un tipo de documento.',
            ]
        );

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

    // Método para mostrar el formulario de edición del perfil del usuario autenticado
    public function editarPerfil()
    {
        // Verificamos si el usuario está autenticado
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Debes iniciar sesión primero.');
        }

        // Obtenemos al usuario autenticado directamente
        $usuario = Auth::user();

        $roles = Rol::all();
        $tiposDocumento = TipoDocumento::all();

        return view('perfil.edit', compact('usuario', 'roles', 'tiposDocumento'));
    }


    public function actualizarPerfil(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Debes iniciar sesión primero.');
        }


        /** @var LoginUsuario $usuario */
        $usuario = Auth::user();


        $request->validate([
            'nombres' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'correo_electronico' => 'required|email|unique:usuarios,correo_electronico,' . $usuario->id,
            'telefono' => 'required|string|max:20',
            'contrasena' => 'nullable|confirmed|confirmed',
        ], [
            'nombres.required' => 'El campo nombres es obligatorio.',
            'nombres.string' => 'El campo nombres debe ser texto.',
            'nombres.max' => 'El campo nombres no puede tener más de 255 caracteres.',

            'apellidos.required' => 'El campo apellidos es obligatorio.',
            'apellidos.string' => 'El campo apellidos debe ser texto.',
            'apellidos.max' => 'El campo apellidos no puede tener más de 255 caracteres.',

            'correo_electronico.required' => 'El correo electrónico es obligatorio.',
            'correo_electronico.email' => 'El correo electrónico debe ser válido.',
            'correo_electronico.unique' => 'El correo electrónico ya está registrado.',

            'telefono.required' => 'El teléfono es obligatorio.',
            'telefono.string' => 'El teléfono debe ser texto.',
            'telefono.max' => 'El teléfono no puede tener más de 20 caracteres.',

            'contrasena.confirmed' => 'Las contraseñas no coinciden.',
            'contrasena.min' => 'La contraseña debe tener al menos 6 caracteres.',
        ]);


        // Usar mass assignment
        $usuario->update($request->only(['nombres', 'apellidos', 'correo_electronico', 'telefono']));

        if ($request->filled('contrasena')) {
            $usuario->contrasena = Hash::make($request->contrasena);
            $usuario->save();
        }

        return redirect()->route('perfil.edit')->with('success', "{$request->nombres} tu informacion fue actualizada correctamente.");
    }
}
