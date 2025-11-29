<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;
use App\Services\BrevoMailService;

class ForgotPasswordController extends Controller
{
    // 1. Mostrar formulario para solicitar código
    public function showEmailForm()
    {
        return view('auth.forgot-password');
    }

    // 2. Generar código y enviarlo por email
    public function sendCode(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'correo_electronico' => 'required|email|exists:usuarios,correo_electronico'
        ]);

        if ($validator->fails()) {
            return back()->withErrors(['correo_electronico' => 'El correo no existe en el sistema']);
        }

        $user = Usuario::where('correo_electronico', $request->correo_electronico)->first();

        // Generar código de 6 dígitos
        $code = rand(100000, 999999);

        // Guardar código y expiración en la base de datos
        $user->reset_code = $code;
        $user->reset_code_expires_at = Carbon::now()->addMinutes(10);
        $user->save();

        // Enviar email con Brevo
        $html = view('emails.codigo_recuperacion', [
            'usuario' => $user,
            'code' => $code,
        ])->render();

        BrevoMailService::sendEmail(
            $user->correo_electronico,
            'Código de recuperación de contraseña',
            $html
        );

        // Guardar email y código en sesión
        session([
            'email' => $user->correo_electronico,
            'code' => $code
        ]);

        return redirect()->route('password.verify.form')
            ->with('success', 'Se envió un código a tu correo.');
    }

    // 3. Mostrar formulario para ingresar código
    public function showVerifyForm()
    {
        if (!session()->has('email')) {
            return redirect()->route('password.forgot');
        }

        $email = session('email');
        return view('auth.verify-code', compact('email'));
    }

    // 4. Verificar código ingresado
    public function verifyCode(Request $request)
    {
        $request->validate([
            'code' => 'required|numeric'
        ]);

        $email = session('email');
        $user = Usuario::where('correo_electronico', $email)->first();

        if (!$user) {
            return back()->withErrors(['code' => 'Usuario no encontrado.']);
        }

        if ($user->reset_code != $request->code) {
            return back()->withErrors(['code' => 'El código es incorrecto.']);
        }

        if (Carbon::now()->greaterThan($user->reset_code_expires_at)) {
            return back()->withErrors(['code' => 'El código ha expirado.']);
        }

        // Guardar código verificado en sesión
        session(['code' => $request->code]);

        return redirect()->route('password.reset.form');
    }

    // 5. Mostrar formulario para restablecer contraseña
    public function showResetForm()
    {
        if (!session()->has('email') || !session()->has('code')) {
            return redirect()->route('password.forgot');
        }

        $email = session('email');
        $code = session('code');

        return view('auth.reset-password', compact('email', 'code'));
    }

    // 6. Actualizar contraseña
    public function resetPassword(Request $request)
    {
        $request->validate([
            'correo_electronico' => 'required|email|exists:usuarios,correo_electronico',
            'code' => 'required|numeric',
            'contrasena' => 'required|string|min:6|confirmed',
        ]);

        $user = Usuario::where('correo_electronico', $request->correo_electronico)->first();

        if (!$user) {
            return back()->withErrors(['correo_electronico' => 'Usuario no encontrado.']);
        }

        if ($user->reset_code != $request->code) {
            return back()->withErrors(['code' => 'El código es incorrecto.']);
        }

        if (Carbon::now()->greaterThan($user->reset_code_expires_at)) {
            return back()->withErrors(['code' => 'El código ha expirado.']);
        }

        // Actualizar contraseña y limpiar código
        $user->contrasena = bcrypt($request->contrasena); // o Hash::make si prefieres
        $user->reset_code = null;
        $user->reset_code_expires_at = null;
        $user->save();

        // Limpiar sesión
        session()->forget(['email', 'code']);

        return redirect()->route('login')->with('success', 'Contraseña restablecida correctamente.');
    }
}
