{{-- resources/views/usuarios/create.blade.php --}}
@extends('layouts.form')

@section('titulo-formulario')
    Registrar Nuevo Usuario <i class="fas fa-user-plus"></i>
@endsection
@section('id-form', 'formulario-usuario')
@section('ruta-accion')
    {{ route('usuarios.store') }}
@endsection
@section('metodo')
    @method('POST')
@endsection
@section('campos-formulario')
    {{-- Campos del formulario para registrar un nuevo usuario --}}
    <div class="row mb-3">
        <div class="col-md-4">
            <div class="form-floating">
                <input type="text" name="documento" class="form-control" id="documento" placeholder="Ej: 12345678" required value="{{ old('documento') }}">
                <label for="documento">Documento</label>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-floating">
                <input type="text" name="nombres" class="form-control" id="nombres" placeholder="Ej: Juan Carlos" required value="{{ old('nombres') }}">
                <label for="nombres">Nombres</label>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-floating">
                <input type="text" name="apellidos" class="form-control" id="apellidos" placeholder="Ej: Pérez Gómez" required value="{{ old('apellidos') }}">
                <label for="apellidos">Apellidos</label>
            </div>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-md-4">
            <div class="form-floating">
                <input type="email" name="correo_electronico" class="form-control" id="correo_electronico" placeholder="Ej: ejemplo@correo.com" required value="{{ old('correo_electronico') }}">
                <label for="correo_electronico">Correo Electrónico</label>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-floating">
                <input type="text" name="telefono" class="form-control" id="telefono" placeholder="Ej: 3001234567" required value="{{ old('telefono') }}">
                <label for="telefono">Teléfono</label>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-floating">
                <input type="password" name="contrasena" class="form-control" id="contrasena" placeholder="Mínimo 6 caracteres" required>
                <label for="contrasena">Contraseña</label>
            </div>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-md-4">
            <div class="form-floating">
                <select name="rol_id" class="form-select" id="rol_id" required>
                    <option value="" disabled {{ old('rol_id') ? '' : 'selected' }}>Selecciona un rol</option>
                    @foreach($roles as $rol)
                        <option value="{{ $rol->id }}" {{ old('rol_id') == $rol->id ? 'selected' : '' }}>
                            {{ $rol->nombre }}
                        </option>
                    @endforeach
                </select>
                <label for="rol_id">Rol</label>
            </div>
        </div>
 

        <div class="col-md-4">
            <div class="form-floating">
                <select name="tipo_documento_id" class="form-select" id="tipo_documento_id" required>
                    <option value="" disabled {{ old('tipo_documento_id') ? '' : 'selected' }}>Selecciona un tipo</option>
                    @foreach($tiposDocumento as $tipo)
                        <option value="{{ $tipo->id }}" {{ old('tipo_documento_id') == $tipo->id ? 'selected' : '' }}>
                            {{ $tipo->descripcion }}
                        </option>
                    @endforeach
                </select>
                <label for="tipo_documento_id">Tipo de Documento</label>
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-end">
        <x-boton-principal href="{{ route('usuarios.index') }}">
            <i class="fas fa-arrow-left"></i> Cancelar
        </x-boton-principal>
        <x-boton-principal type="submit">
            <i class="fas fa-user-plus"></i> Guardar
        </x-boton-principal>
    </div>
@endsection
