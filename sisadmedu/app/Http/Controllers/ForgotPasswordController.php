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
        ], [
            'correo_electronico.required' => 'El correo electrónico es obligatorio.',
            'correo_electronico.email'    => 'El correo electrónico debe tener un formato válido.',
            'correo_electronico.exists'   => 'El correo electrónico no está registrado en el sistema.',
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
            'correo_electronico' => 'required|email|exists:usuarios,correo_electronico',
            'code' => 'required|digits:6',
        ], [
            'correo_electronico.required' => 'El correo electrónico es obligatorio.',
            'correo_electronico.email'    => 'El correo electrónico no es válido.',
            'correo_electronico.exists'   => 'El correo electrónico no está registrado en el sistema.',

            'code.required' => 'El código de verificación es obligatorio.',
            'code.digits'   => 'El código de verificación debe tener exactamente 6 dígitos.',
        ]);

        $user = Usuario::where('correo_electronico', $request->correo_electronico)->first();

        if (!$user || $user->reset_code !== $request->code || Carbon::now()->greaterThan($user->reset_code_expires_at)) {
            return back()->withErrors(['code' => 'El código no es válido o ha expirado, por favor reenvíalo nuevamente.'])->withInput();
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

    public function resetPassword(Request $request)
    {
        $request->validate([
            'correo_electronico' => 'required|email|exists:usuarios,correo_electronico',
            'code' => 'required|digits:6',
            'contrasena' => 'required|min:6|confirmed',
        ], [
            // Correo
            'correo_electronico.required' => 'El correo electrónico es obligatorio.',
            'correo_electronico.email'    => 'El correo electrónico no es válido.',
            'correo_electronico.exists'   => 'El correo electrónico no está registrado en el sistema.',

            // Código
            'code.required' => 'El código de verificación es obligatorio.',
            'code.digits'   => 'El código de verificación debe tener exactamente 6 números.',

            // Contraseña
            'contrasena.required' => 'La nueva contraseña es obligatoria.',
            'contrasena.min'      => 'La contraseña debe tener al menos 6 caracteres.',
            'contrasena.confirmed' => 'Las contraseñas no coinciden.',
        ]);

        $user = Usuario::where('correo_electronico', $request->correo_electronico)
            ->where('reset_code', $request->code)
            ->first();

        if (!$user || Carbon::now()->greaterThan($user->reset_code_expires_at)) {
            return back()
                ->withErrors(['code' => 'El código no es válido o ha expirado, por favor solicita uno nuevo.'])
                ->withInput();
        }

        // Validar que la contraseña no sea igual al documento
        if ($request->contrasena === $user->documento) {
            return back()
                ->withErrors(['contrasena' => 'La contraseña no puede ser igual a tu documento.'])
                ->withInput();
        }

        // Actualizar contraseña
        $user->contrasena = Hash::make($request->contrasena);
        $user->reset_code = null;
        $user->reset_code_expires_at = null;
        $user->save();

        return redirect()->route('login')->with('success', 'Tu contraseña ha sido restablecida correctamente.');
    }
}
