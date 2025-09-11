<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\LoginUsuario;
use App\Models\Usuario;

class LoginController extends Controller
{
    // Método para mostrar el formulario de inicio de sesión
    // Verifica si el usuario ya está autenticado
    // Si está autenticado, redirige al dashboard
    // Si no, muestra el formulario de inicio de sesión
    public function showLoginForm()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }
        return view('auth.login');
    }



    // Método para manejar el inicio de sesión
    // Validación de las credenciales del usuario
    // Si las credenciales son correctas, se inicia sesión
    // Si las credenciales son incorrectas, se redirige de vuelta con un mensaje
    // de error
    public function login(Request $request)
    {
        $request->validate([
            'correo_electronico' => 'required|email',
            'contrasena' => 'required|min:6',
        ]);

        // Intentamos autenticar con Auth
        if (Auth::attempt([
            'correo_electronico' => $request->correo_electronico,
            'password' => $request->contrasena
        ])) {
            // Regeneramos la sesión para mayor seguridad
            $request->session()->regenerate();

            $usuario = Auth::user(); // Usuario autenticado

            // Lógica de contraseña por defecto
            // Comprobamos si la contraseña coincide con el documento
            if (Hash::check($usuario->documento, $usuario->contrasena)) {
                // Guardamos flag en sesión
                $request->session()->put('debe_cambiar_contrasena', true);

                // Redirigimos al formulario de cambio de contraseña
                return redirect()->route('dashboard')
                    ->with('success', 'Bienvenido, ' . $usuario->nombres . '! Debes cambiar tu contraseña por seguridad.');
            }

            // Si no es la contraseña por defecto, login normal
            $request->session()->put('debe_cambiar_contrasena', false);
            return redirect()->route('dashboard')
                ->with('success', 'Bienvenido, ' . $usuario->nombres);
        }

        // Login fallido
        return back()
            ->with('error', 'Credenciales incorrectas.')
            ->withInput();
    }




    // Método para cerrar sesión
    public function logout(Request $request)
    {
        Auth::logout();
        // Invalida la sesión actual y regenera el token CSRF
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')
            ->with('success', 'Has cerrado sesión exitosamente.');
    }


    public function formCambiarContrasena()
    {
        // Solo permitir acceso si está usando contraseña por defecto
        if (!session('debe_cambiar_contrasena')) {
            return redirect()->route('dashboard');
        }

        return view('usuarios.cambiar_contrasena');
    }

    public function actualizarContrasena(Request $request)
    {
        // Validar la nueva contraseña y su confirmación
        $request->validate([
            'nueva_contrasena' => 'required|min:6|confirmed',
        ], [
            'nueva_contrasena.required' => 'Por favor ingresa una nueva contraseña.',
            'nueva_contrasena.min' => 'La nueva contraseña debe tener al menos 6 caracteres.',
            'nueva_contrasena.confirmed' => 'La confirmación de la contraseña no coincide.',
        ]);

        // Obtener el usuario autenticado
        /** @var LoginUsuario $usuario */
        $usuario = Auth::user();

        if (!$usuario) {
            return redirect()->route('login')->with('error', 'Usuario no encontrado.');
        }

        // Validar que la nueva contraseña no sea igual a la actual
        if ($request->nueva_contrasena === $usuario->documento) {
            return back()->withErrors([
                'nueva_contrasena' => 'La contraseña no puede ser igual a tu documento.'
            ])->withInput();
        }

        // 3️⃣ Actualizar la contraseña
        $usuario->contrasena = Hash::make($request->nueva_contrasena);
        $usuario->save();

        // 4️⃣ Limpiar el flag de sesión
        session()->forget('debe_cambiar_contrasena');

        // 5 Redirigir con mensaje de éxito
        return redirect()->route('dashboard')->with('success', 'Contraseña actualizada exitosamente.');
    }
}
