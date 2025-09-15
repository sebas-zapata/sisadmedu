@php($ocultarNavbar = true)
@extends('layouts.app')

@section('title', 'Recuperar contraseña')

@section('contenido')
<div class="login-container">
    <div id="particles-js"></div>
    <div class="login-box">
        <h2 class="fw-bold">¿Olvidaste tu contraseña?</h2>
        <p class="text-muted mb-4">Ingresa tu correo electrónico y te enviaremos un código de verificación.</p>

        <form action="{{ route('password.send.code') }}" method="POST">
            @csrf
<div class="form-floating mb-3">
    <input 
        type="email" 
        class="form-control @error('correo_electronico') is-invalid @enderror" 
        id="correo_electronico" 
        name="correo_electronico" 
        placeholder="Correo electrónico"
        value="{{ old('correo_electronico') }}"
    >
    <label for="correo_electronico">Correo electrónico</label>

    @error('correo_electronico')
        <div class="invalid-feedback p-2" style="background-color: #ffe6e6; border-radius: 4px;">
            {{ $message }}
        </div>
    @enderror
</div>


            <button class="btn-login w-100" type="submit">Enviar código</button>
        </form>

        <hr>
        <div class="mt-3 text-center small">
            <a href="{{ route('login') }}" class="text-decoration-none">Volver al inicio de sesión</a>
        </div>
    </div>
</div>
@endsection
