@php($ocultarNavbar = true)
@extends('layouts.app')

@section('title', 'Verificar código')

@section('contenido')
<div class="login-container">
    <div id="particles-js"></div>
    <div class="login-box">
        <h2 class="fw-bold">Verificar código</h2>
        <p class="text-muted mb-4">Hemos enviado un código de 6 dígitos a tu correo <b>{{ $email }}</b>. Ingrésalo aquí.</p>

        {{-- Mostrar errores --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('password.verify') }}" method="POST">
            @csrf
            <input type="hidden" name="correo_electronico" value="{{ $email }}">

            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="code" name="code" placeholder="Código" maxlength="6" required>
                <label for="code">Código de verificación</label>
            </div>

            <button class="btn-login w-100" type="submit">Verificar</button>
        </form>

        <hr>
        <div class="mt-3 text-center small">
            <a href="{{ route('password.forgot') }}" class="text-decoration-none">Volver</a>
        </div>
    </div>
</div>
@endsection
