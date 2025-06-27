@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">Registrar Nuevo Usuario <i class="fas fa-user-plus"></i></h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>¡Atención!</strong> Corrige los siguientes errores:
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form id="formulario-usuario" action="{{ route('usuarios.store') }}" method="POST" novalidate>
        @csrf

        <div class="row mb-3">
            <div class="col-md-4">
                <label class="form-label">Documento</label>
                <input type="text" name="documento" class="form-control" placeholder="Ej: 12345678" required value="{{ old('documento') }}">
            </div>
            <div class="col-md-4">
                <label class="form-label">Nombres</label>
                <input type="text" name="nombres" class="form-control" placeholder="Ej: Juan Carlos" required value="{{ old('nombres') }}">
            </div>
            <div class="col-md-4">
                <label class="form-label">Apellidos</label>
                <input type="text" name="apellidos" class="form-control" placeholder="Ej: Pérez Gómez" required value="{{ old('apellidos') }}">
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-4">
                <label class="form-label">Correo Electrónico</label>
                <input type="email" name="correo_electronico" class="form-control" placeholder="Ej: ejemplo@correo.com" required value="{{ old('correo_electronico') }}">
            </div>
            <div class="col-md-4">
                <label class="form-label">Teléfono</label>
                <input type="text" name="telefono" class="form-control" placeholder="Ej: 3001234567" required value="{{ old('telefono') }}">
            </div>
            <div class="col-md-4">
                <label class="form-label">Contraseña</label>
                <input type="password" name="contrasena" class="form-control" placeholder="Mínimo 6 caracteres" required>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-4">
                <label class="form-label">Rol</label>
                <select name="rol_id" class="form-select" required>
                    <option value="">Selecciona un rol</option>
                    @foreach($roles as $rol)
                        <option value="{{ $rol->id }}" {{ old('rol_id') == $rol->id ? 'selected' : '' }}>
                            {{ $rol->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-4">
                <label class="form-label">Tipo de Documento</label>
                <select name="tipo_documento_id" class="form-select" required>
                    <option value="">Selecciona un tipo</option>
                    @foreach($tiposDocumento as $tipo)
                        <option value="{{ $tipo->id }}" {{ old('tipo_documento_id') == $tipo->id ? 'selected' : '' }}>
                            {{ $tipo->descripcion }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-4">
                <label class="form-label">Grupo (opcional)</label>
                <select name="grupo_id" class="form-select">
                    <option value="">Sin grupo</option>
                    @foreach($grupos as $grupo)
                        <option value="{{ $grupo->id }}" {{ old('grupo_id') == $grupo->id ? 'selected' : '' }}>
                            {{ $grupo->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="d-flex justify-content-end">
            <a href="{{ route('usuarios.index') }}" class="btn btn-cancelar btn-secondary m-2 p-2"><i class="fas fa-arrow-left"></i> Cancelar</a>
            <button type="submit" class="btn btn-crear m-2 p-2"><i class="fas fa-user-plus"></i> Guardar</button>
        </div>
    </form>
</div>
@endsection
