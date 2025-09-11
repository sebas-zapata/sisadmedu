<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class ForgotPasswordController extends Controller
{
    // 1. Mostrar formulario para ingresar el correo
    public function showEmailForm()
    {
        return view('auth.forgot-password');
    }

    // 2. Enviar código de 6 dígitos al correo
    public function sendCode(Request $request)
    {
        $request->validate([
            'correo_electronico' => 'required|email|exists:usuarios,correo_electronico',
        ]);

        $user = Usuario::where('correo_electronico', $request->correo_electronico)->first();

        // Generar código de 6 dígitos
        $code = rand(100000, 999999);

        $user->reset_code = $code;
        $user->reset_code_expires_at = Carbon::now()->addMinutes(10); // expira en 10 min
        $user->save();

        // Enviar correo con SendGrid (ya configurado)
        Mail::raw("Tu código de recuperación es: $code", function ($message) use ($user) {
            $message->to($user->correo_electronico)
                    ->subject('Código de recuperación de contraseña');
        });

        return redirect()->route('password.verify.form')
                         ->with('email', $user->correo_electronico);
    }

    // 3. Mostrar formulario para ingresar el código
    public function showVerifyForm(Request $request)
    {
        $email = session('email');
        return view('auth.verify-code', compact('email'));
    }

    // 4. Verificar código
    public function verifyCode(Request $request)
    {
        $request->validate([
            'correo_electronico' => 'required|email',
            'code' => 'required|digits:6',
        ]);

        $user = Usuario::where('correo_electronico', $request->correo_electronico)->first();

        if (!$user || $user->reset_code !== $request->code || Carbon::now()->greaterThan($user->reset_code_expires_at)) {
            return back()->withErrors(['code' => 'El código no es válido o ha expirado']);
        }

        return redirect()->route('password.reset.form')
                         ->with(['email' => $user->correo_electronico, 'code' => $request->code]);
    }

    // 5. Mostrar formulario para nueva contraseña
    public function showResetForm(Request $request)
    {
        $email = session('email');
        $code = session('code');
        return view('auth.reset-password', compact('email', 'code'));
    }

    // 6. Guardar nueva contraseña
    public function resetPassword(Request $request)
    {
        $request->validate([
            'correo_electronico' => 'required|email',
            'code' => 'required|digits:6',
            'contrasena' => 'required|min:6|confirmed',
        ]);

        $user = Usuario::where('correo_electronico', $request->correo_electronico)
                       ->where('reset_code', $request->code)
                       ->first();

        if (!$user || Carbon::now()->greaterThan($user->reset_code_expires_at)) {
            return back()->withErrors(['code' => 'El código no es válido o ha expirado']);
        }

        // Actualizar contraseña
        $user->contrasena = Hash::make($request->contrasena);
        $user->reset_code = null;
        $user->reset_code_expires_at = null;
        $user->save();

        return redirect()->route('login')->with('success', 'Tu contraseña ha sido restablecida correctamente.');
    }
}
