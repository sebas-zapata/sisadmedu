@php($ocultarNavbar = true)
@extends('layouts.app')

@section('title', 'Verificar código')

@section('contenido')
<div class="login-container">
    <div id="particles-js"></div>
    <div class="login-box">
        <h2 class="fw-bold">Verificar código</h2>
        <p class="text-muted mb-4">
            Hemos enviado un código de 6 dígitos a tu correo <b>{{ $email }}</b>. Ingrésalo aquí.
        </p>

        {{-- Formulario para verificar código --}}
        <form action="{{ route('password.verify') }}" method="POST">
            @csrf
            <input type="hidden" name="correo_electronico" value="{{ $email }}">

            <div class="form-floating mb-3">
                <input 
                    type="text" 
                    class="form-control @error('code') is-invalid @enderror" 
                    id="code" 
                    name="code" 
                    placeholder="Código" 
                    maxlength="6" 
                    value="{{ old('code') }}" 
                >
                <label for="code">Código de verificación</label>

                @error('code')
                    <div class="invalid-feedback p-2" style="background-color: #ffe6e6; border-radius: 4px;">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <button class="btn-login w-100 mb-2" type="submit">Verificar</button>
        </form>

        <hr>
        <div class="mt-3 text-center small">
            <a href="{{ route('password.forgot') }}" class="text-decoration-none">Volver</a>
        </div>
    </div>
</div>
@endsection
