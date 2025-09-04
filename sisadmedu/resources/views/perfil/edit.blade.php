{{-- resources/views/usuarios/perfil.blade.php --}}
@extends('layouts.form')

@section('titulo-formulario', 'Editar Perfil')

@section('id-form', 'form-editar-perfil')

@section('ruta-accion', route('perfil.update'))

@section('metodo')
    @method('PUT')
@endsection

@section('campos-formulario')
    <div class="mb-3">
        <label for="nombres" class="form-label text-light">Nombres</label>
        <input type="text" name="nombres" id="nombres"
               class="form-control"
               value="{{ old('nombres', $usuario->nombres) }}" required>
    </div>

    <div class="mb-3">
        <label for="apellidos" class="form-label text-light">Apellidos</label>
        <input type="text" name="apellidos" id="apellidos"
               class="form-control"
               value="{{ old('apellidos', $usuario->apellidos) }}" required>
    </div>

    <div class="mb-3">
        <label for="correo_electronico" class="form-label text-light">Correo electrónico</label>
        <input type="email" name="correo_electronico" id="correo_electronico"
               class="form-control"
               value="{{ old('correo_electronico', $usuario->correo_electronico) }}" required>
    </div>

    <div class="mb-3">
        <label for="telefono" class="form-label text-light">Teléfono</label>
        <input type="text" name="telefono" id="telefono"
               class="form-control"
               value="{{ old('telefono', $usuario->telefono) }}">
    </div>

    <div class="mb-3">
        <label for="contrasena" class="form-label text-light">Contraseña (opcional)</label>
        <input type="password" name="contrasena" id="contrasena"
               class="form-control"
               placeholder="Dejar en blanco si no deseas cambiarla">
    </div>
@endsection

@section('botones-formulario')
    <a href="{{ route('dashboard') }}" class="btn btn-secondary me-2">
        <i class="fas fa-arrow-left"></i> Volver
    </a>
    <button type="submit" class="btn btn-primary">
        <i class="fas fa-save"></i> Guardar cambios
    </button>
@endsection
