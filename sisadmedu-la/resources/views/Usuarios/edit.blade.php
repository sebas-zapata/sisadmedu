@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="mb-4 text-light"><i class="fas fa-edit"></i> Editar Usuario</h2>

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

    <form action="{{ route('usuarios.update', $usuario->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row mb-3">
            <div class="col-md-4">
                <label for="documento" class="form-label">Documento</label>
                <input type="text" name="documento" class="form-control" required value="{{ old('documento', $usuario->documento) }}">
            </div>
            <div class="col-md-4">
                <label for="nombres" class="form-label">Nombres</label>
                <input type="text" name="nombres" class="form-control" required value="{{ old('nombres', $usuario->nombres) }}">
            </div>
            <div class="col-md-4">
                <label for="apellidos" class="form-label">Apellidos</label>
                <input type="text" name="apellidos" class="form-control" required value="{{ old('apellidos', $usuario->apellidos) }}">
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-4">
                <label for="correo_electronico" class="form-label">Correo Electrónico</label>
                <input type="email" name="correo_electronico" class="form-control" required value="{{ old('correo_electronico', $usuario->correo_electronico) }}">
            </div>
            <div class="col-md-4">
                <label for="telefono" class="form-label">Teléfono</label>
                <input type="text" name="telefono" class="form-control" required value="{{ old('telefono', $usuario->telefono) }}">
            </div>
            <div class="col-md-4">
                <label for="contrasena" class="form-label">Nueva Contraseña <small class="text-muted">(dejar vacío para no cambiar)</small></label>
                <input type="password" name="contrasena" class="form-control">
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-4">
                <label for="rol_id" class="form-label">Rol</label>
                <select name="rol_id" class="form-select" required>
                    @foreach($roles as $rol)
                    <option value="{{ $rol->id }}" {{ $usuario->rol_id == $rol->id ? 'selected' : '' }}>
                        {{ $rol->nombre }}
                    </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-4">
                <label for="tipo_documento_id" class="form-label">Tipo de Documento</label>
                <select name="tipo_documento_id" class="form-select" required>
                    @foreach($tiposDocumento as $tipo)
                    <option value="{{ $tipo->id }}" {{ $usuario->tipo_documento_id == $tipo->id ? 'selected' : '' }}>
                        {{ $tipo->descripcion }}
                    </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-4">
                <label for="grupo_id" class="form-label">Grupo (opcional)</label>
                <select name="grupo_id" class="form-select">
                    <option value="">Sin grupo</option>
                    @foreach($grupos as $grupo)
                    <option value="{{ $grupo->id }}" {{ $usuario->grupo_id == $grupo->id ? 'selected' : '' }}>
                        {{ $grupo->nombre }}
                    </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="d-flex justify-content-end">
            <a href="{{ route('usuarios.index') }}" class="btn btn-cancelar m-2 p-2 text-light rounded-2"> <i class="fas fa-arrow-left"></i> Cancelar</a>
            <button type="submit" class="btn btn-actualizar m-2 p-2 text-light rounded-2"><i class="fa-solid fa-rotate-right"></i>
                Actualizar</button>
        </div>
    </form>
</div>
@endsection