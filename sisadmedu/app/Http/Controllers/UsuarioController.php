<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use App\Models\LoginUsuario;
use App\Models\Rol;
use App\Models\TipoDocumento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UsuarioController extends Controller
{
    // Método para mostrar la lista de usuarios
    // Este método obtiene todos los usuarios con sus roles y tipos de documento
    // y retorna la vista 'usuarios.index' con los datos
    // de los usuarios para ser mostrados en una tabla
    // Se utiliza el método 'with' para cargar las relaciones de rol y tipoDocumento
    public function index()
    {
        if (in_array(Auth::user()->rol->nombre, ['Docente', 'Estudiante', 'Acudiente'])) {
            return redirect()->route('dashboard')
                ->with('error', 'No tienes permiso para crear usuarios.');
        }

        $roles = Rol::all();
        $usuarios = Usuario::with(['rol', 'tipoDocumento'])->get();
        return view('usuarios.index', compact('usuarios', 'roles'));
    }

    // Método para mostrar el formulario de creación de un nuevo usuario
    public function create()
    {
        if (in_array(Auth::user()->rol->nombre, ['Docente', 'Estudiante', 'Acudiente'])) {
            return redirect()->route('dashboard')
                ->with('error', 'No tienes permiso para crear usuarios.');
        }


        $roles = Rol::whereNotIn('nombre', ['Docente', 'Estudiante'])->get();

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
        if (in_array(Auth::user()->rol->nombre, ['Docente', 'Estudiante', 'Acudiente'])) {
            return redirect()->route('dashboard')
                ->with('error', 'No tienes permiso para crear usuarios.');
        }

        // Validar los datos del formulario
        $request->validate(
            [
                'documento' => 'required|numeric|unique:usuarios',
                'nombres' => 'required',
                'apellidos' => 'required',
                'correo_electronico' => 'required|email|unique:usuarios',
                'rol_id' => 'required|exists:roles,id',
                'tipo_documento_id' => 'required|exists:tipos_documento,id',
                'celular' => 'required|string|max:20|unique:usuarios,celular',
                // validación para estudiante_id solo si es acudiente
                'estudiante_id' => 'nullable|exists:estudiantes,id',
            ],
            [
                'documento.required' => 'El campo documento es obligatorio.',
                'documento.unique' => 'El documento ya está registrado.',
                'documento.numeric' => 'El campo documento debe ser un número.',
                'nombres.required' => 'El campo nombres es obligatorio.',
                'apellidos.required' => 'El campo apellidos es obligatorio.',
                'correo_electronico.required' => 'El campo correo electrónico es obligatorio.',
                'correo_electronico.email' => 'El campo correo electrónico debe ser una dirección de correo válida.',
                'correo_electronico.unique' => 'El correo electrónico ya está registrado.',
                'celular.required' => 'El campo celular es obligatorio.',
                'celular.unique' => 'El celular ya está registrado.',
                'rol_id.required' => 'Debe seleccionar un rol.',
                'tipo_documento_id.required' => 'Debe seleccionar un tipo de documento.',
            ]
        );

        // Obtener todos los datos del formulario
        $datos = $request->all();

        // Asignar el documento como contraseña por defecto
        $datos['contrasena'] = Hash::make($request->documento);

        // Crear el usuario en la base de datos
        $usuario = Usuario::create($datos);

        // 2️⃣ Verificar si el usuario es acudiente y se seleccionó un estudiante
        $rolAcudiente = Rol::where('nombre', 'Acudiente')->first();
        if ($rolAcudiente && $request->rol_id == $rolAcudiente->id && $request->filled('estudiante_id')) {
            $usuario->estudiantes()->attach($request->estudiante_id);
        }

        return redirect()->route('usuarios.index')
            ->with('success', "Usuario creado correctamente. La contraseña inicial es el documento del usuario.");
    }




    // Método para mostrar un usuario específico
    // Este método busca el usuario por su ID y retorna la vista 'usuarios.show'
    // con los datos del usuario, incluyendo su rol y tipo de documento
    // Se utiliza el método 'with' para cargar las relaciones de rol y tipoDocumento
    public function show($id)
    {
        if (in_array(Auth::user()->rol->nombre, ['Docente', 'Estudiante', 'Acudiente'])) {
            return redirect()->route('dashboard')
                ->with('error', 'No tienes permiso para crear usuarios.');
        }

        // Cargar rol, tipoDocumento y estudiantes asociados
        $usuario = Usuario::with(['rol', 'tipoDocumento', 'estudiantes'])->findOrFail($id);

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
        if (in_array(Auth::user()->rol->nombre, ['Docente', 'Estudiante', 'Acudiente'])) {
            return redirect()->route('dashboard')
                ->with('error', 'No tienes permiso para crear usuarios.');
        }
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
        if (in_array(Auth::user()->rol->nombre, ['Docente', 'Estudiante', 'Acudiente'])) {
            return redirect()->route('dashboard')
                ->with('error', 'No tienes permiso para crear usuarios.');
        }
        $usuario = Usuario::findOrFail($id);

        $request->validate(
            [
                'documento' => 'required|string|max:20|unique:usuarios,documento,' . $usuario->id,
                'nombres' => 'required|string|max:100',
                'apellidos' => 'required|string|max:100',
                'correo_electronico' => 'required|email|unique:usuarios,correo_electronico,' . $usuario->id,
                'celular' => 'required|string|max:20|unique:usuarios,celular,' . $usuario->id,
                'rol_id' => 'exists:roles,id',
                'tipo_documento_id' => 'required|exists:tipos_documento,id',

                // Contraseña solo si la quiere cambiar
                'contrasena' => 'nullable|min:6|confirmed',
                'estudiante_id' => 'nullable|exists:estudiantes,id',
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
                'celular.required' => 'El campo celular es obligatorio.',
                'celular.unique' => 'El celular ya está registrado.',
                'contrasena.min' => 'La contraseña debe tener al menos 6 caracteres.',
                'contrasena.confirmed' => 'La confirmación de la contraseña no coincide.',
                'tipo_documento_id.required' => 'Debe seleccionar un tipo de documento.',
            ]
        );

        // arma manualmente el array de actualización — evita sorpresas
        $datos = $request->only([
            'documento',
            'nombres',
            'apellidos',
            'correo_electronico',
            'celular',
            'rol_id',
            'tipo_documento_id'
        ]);

        // sólo cambiar la contraseña si viene en el formulario
        if ($request->filled('contrasena')) {
            $datos['contrasena'] = Hash::make($request->contrasena);
        }

        $usuario->update($datos);

        // Actualizar la relación si es acudiente
        $rolAcudiente = Rol::where('nombre', 'Acudiente')->first();
        if ($rolAcudiente && $request->rol_id == $rolAcudiente->id) {
            if ($request->filled('estudiante_id')) {
                // sincroniza el acudiente con un solo estudiante (reemplaza)
                $usuario->estudiantes()->sync([$request->estudiante_id]);
            } else {
                // si no selecciona ninguno, elimina las relaciones
                $usuario->estudiantes()->detach();
            }
        }

        return redirect()->route('usuarios.index')->with('success', 'Usuario actualizado correctamente.');
    }

    // Método para eliminar un usuario
    // Este método busca el usuario por su ID y lo elimina de la base de datos
    // Envia mensaje de éxito al redirigir a la lista de usuarios
    public function destroy($id)
    {
        if (in_array(Auth::user()->rol->nombre, ['Docente', 'Estudiante', 'Acudiente'])) {
            return redirect()->route('dashboard')
                ->with('error', 'No tienes permiso para eliminar usuarios.');
        }

        // Cargar usuario con relaciones
        $usuario = Usuario::with(['estudiante', 'docente', 'estudiantes'])->findOrFail($id);

        DB::transaction(function () use ($usuario) {

            // 1. Si es estudiante, eliminar su registro en estudiantes
            if ($usuario->estudiante) {
                $usuario->estudiante->delete();
            }

            // 2. Si es docente, eliminar su registro en docentes
            if ($usuario->docente) {
                $usuario->docente->delete();
            }

            // 3. Si es acudiente, eliminar relaciones pivot
            if ($usuario->rol->nombre === 'Acudiente') {
                $usuario->estudiantes()->detach();
            }

            // 4. Ahora sí eliminar el usuario
            $usuario->delete();
        });

        return redirect()->route('usuarios.index')
            ->with('success', 'Usuario eliminado correctamente.');
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
            'correo_electronico' => 'email|unique:usuarios,correo_electronico,' . $usuario->id,
            'celular' => 'required|string|max:20|unique:usuarios,celular,' . $usuario->id,
            'contrasena' => 'nullable|confirmed|min:6',
        ], [
            'nombres.required' => 'El campo nombres es obligatorio.',
            'nombres.string'   => 'El campo nombres debe ser texto.',
            'nombres.max'      => 'El campo nombres no puede tener más de 255 caracteres.',
            'apellidos.required' => 'El campo apellidos es obligatorio.',
            'apellidos.string'   => 'El campo apellidos debe ser texto.',
            'apellidos.max'      => 'El campo apellidos no puede tener más de 255 caracteres.',
            'correo_electronico.email'    => 'El correo electrónico debe ser válido.',
            'correo_electronico.unique'   => 'El correo electrónico ya está registrado.',
            'celular.required' => 'El campo celular es obligatorio.',
            'celular.unique' => 'El celular ya está registrado.',
            'contrasena.confirmed' => 'Las contraseñas no coinciden.',
            'contrasena.min'       => 'La contraseña debe tener al menos 6 caracteres.',
        ]);


        // Validar que la contraseña no sea igual al documento
        if ($request->filled('contrasena') && $request->contrasena === $usuario->documento) {
            return back()->withErrors(['contrasena' => 'La contraseña no puede ser igual al documento.']);
        }

        // Usar mass assignment
        $usuario->update($request->only(['nombres', 'apellidos', 'correo_electronico', 'celular']));

        if ($request->filled('contrasena')) {
            $usuario->contrasena = Hash::make($request->contrasena);
            $usuario->save();
        }

        return redirect()->route('perfil.edit')->with('success', "{$request->nombres} tu información fue actualizada correctamente.");
    }

    public function buscarAcudientes(Request $request)
    {
        $query = strtolower($request->get('query')); // pasamos todo a minúsculas para que coincida

        $acudientes = Usuario::whereHas('rol', function ($q) {
            $q->whereRaw('LOWER(nombre) = ?', ['acudiente']);
        })
            ->where(function ($q) use ($query) {
                $q->whereRaw("LOWER(CONCAT(nombres, ' ', apellidos)) LIKE ?", ["%{$query}%"])
                    ->orWhereRaw("LOWER(nombres) LIKE ?", ["%{$query}%"])
                    ->orWhereRaw("LOWER(apellidos) LIKE ?", ["%{$query}%"])
                    ->orWhereRaw("documento LIKE ?", ["%{$query}%"]);
            })
            ->limit(10)
            ->get(['id', 'nombres', 'apellidos', 'documento']);

        return response()->json($acudientes);
    }

    public function acudienteInformacion()
    {
        // Obtener el usuario que inició sesión
        $usuario = Auth::user(); // ← devuelve LoginUsuario
        $estudiante = $usuario->estudiantes->first();

        return view('acudiente.informacion-acudiente', compact('usuario', 'estudiante'));
    }
}
