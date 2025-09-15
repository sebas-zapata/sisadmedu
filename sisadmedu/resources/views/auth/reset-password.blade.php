@php($ocultarNavbar = true)
@extends('layouts.app')

@section('title', 'Restablecer contraseña')

@section('contenido')
<div class="login-container">
    <div id="particles-js"></div>
    <div class="login-box">
        <h2 class="fw-bold">Restablecer contraseña</h2>
        <p class="text-muted mb-4">Ingresa tu nueva contraseña para tu cuenta.</p>

        <form action="{{ route('password.reset') }}" method="POST">
            @csrf
            <input type="hidden" name="correo_electronico" value="{{ $email }}">
            <input type="hidden" name="code" value="{{ $code }}">

            {{-- Contraseña --}}
            <div class="form-floating mb-3">
                <input 
                    type="password" 
                    class="form-control @error('contrasena') is-invalid @enderror" 
                    id="contrasena" 
                    name="contrasena" 
                    placeholder="Nueva contraseña" 
                    >
                <label for="contrasena">Nueva contraseña</label>
                @error('contrasena')
                    <div class="invalid-feedback p-2" style="background-color: #ffe6e6; border-radius: 4px;">{{ $message }}</div>
                @enderror
            </div>

            {{-- Confirmación de contraseña --}}
            <div class="form-floating mb-3">
                <input 
                    type="password" 
                    class="form-control @error('contrasena_confirmation') is-invalid @enderror" 
                    id="contrasena_confirmation" 
                    name="contrasena_confirmation" 
                    placeholder="Confirmar contraseña" 
                    >
                <label for="contrasena_confirmation">Confirmar contraseña</label>
                @error('contrasena_confirmation')
                    <div class="invalid-feedback p-2" style="background-color: #ffe6e6; border-radius: 4px;">{{ $message }}</div>
                @enderror
            </div>

            <button class="btn-login w-100" type="submit">Restablecer contraseña</button>
        </form>

        <hr>
        <div class="mt-3 text-center small">
            <a href="{{ route('login') }}" class="text-decoration-none">Volver al inicio de sesión</a>
        </div>
    </div>
</div>
@endsection
