@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            
            <div class="card">
                <div class="card-header">Editar Usuario</div>

                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <strong>¡Error!</strong> Hay problemas con los datos ingresados.
                            <ul class="mb-0 mt-2">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('usuarios.update', $usuario->id_usuario) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="tipo_documento_codigo_tipo_documento" class="form-label">Tipo de Documento</label>
                                <select class="form-select" name="tipo_documento_codigo_tipo_documento" required>
                                    @foreach ($tiposDocumento as $tipoDocumento)
                                        <option value="{{ $tipoDocumento->codigo_tipo_documento }}" {{ $usuario->tipo_documento_codigo_tipo_documento == $tipoDocumento->codigo_tipo_documento ? 'selected' : '' }}>
                                            {{ $tipoDocumento->descripcion_tipo_documento }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="documento_usuario" class="form-label">Número de Documento</label>
                                <input type="number" class="form-control" name="documento_usuario" value="{{ $usuario->documento_usuario }}" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="nombres_usuario" class="form-label">Nombres</label>
                                <input type="text" class="form-control" name="nombres_usuario" value="{{ $usuario->nombres_usuario }}" required>
                            </div>
                            <div class="col-md-6">
                                <label for="apellidos_usuario" class="form-label">Apellidos</label>
                                <input type="text" class="form-control" name="apellidos_usuario" value="{{ $usuario->apellidos_usuario }}" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="telefono_usuario" class="form-label">Teléfono</label>
                                <input type="text" class="form-control" name="telefono_usuario" value="{{ $usuario->telefono_usuario }}" required>
                            </div>
                            <div class="col-md-6">
                                <label for="correo_electronico_usuario" class="form-label">Correo Electrónico</label>
                                <input type="email" class="form-control" name="correo_electronico_usuario" value="{{ $usuario->correo_electronico_usuario }}" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="contrasena_usuario" class="form-label">Contraseña (dejar en blanco para mantener la actual)</label>
                                <input type="password" class="form-control" name="contrasena_usuario" placeholder="Ingrese nueva contraseña si desea cambiarla">
                            </div>
                            <div class="col-md-6">
                                <label for="rol_id_rol" class="form-label">Rol</label>
                                <select class="form-select" name="rol_id_rol" id="rol_id_rol" required onchange="mostrarGrupo()">
                                    @foreach ($roles as $rol)
                                        <option value="{{ $rol->id_rol }}" {{ $usuario->rol_id_rol == $rol->id_rol ? 'selected' : '' }}>
                                            {{ $rol->rol }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3" id="grupo_container" style="display: none;">
                            <div class="col-md-6">
                                <label for="grupo_id_grupo" class="form-label">Grupo</label>
                                <select class="form-select" name="grupo_id_grupo" id="grupo_id_grupo">
                                    <option value="">Seleccione un grupo</option>
                                    @foreach ($grupos as $grupo)
                                        <option value="{{ $grupo->id_grupo }}" {{ $usuario->grupo_id_grupo == $grupo->id_grupo ? 'selected' : '' }}>
                                            {{ $grupo->nombre_grupo }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="d-flex justify-content-center gap-3 mt-4">
                            <button type="submit" class="btn btn-primary">Actualizar</button>
                            <a href="{{ route('usuarios.index') }}" class="btn btn-secondary">Cancelar</a>
                        </div>
                    </form>
                </div> <!-- /.card-body -->
            </div> <!-- /.card -->

        </div>
    </div>
</div>

<script>
    function mostrarGrupo() {
        const rolSeleccionado = document.getElementById('rol_id_rol').value;
        const rolEstudiante = @json(App\Models\Rol::where('rol', 'Estudiante')->first()->id_rol ?? 0);

        const grupoContainer = document.getElementById('grupo_container');
        const grupoSelect = document.getElementById('grupo_id_grupo');

        if (rolSeleccionado == rolEstudiante) {
            grupoContainer.style.display = 'block';
            grupoSelect.required = true;
        } else {
            grupoContainer.style.display = 'none';
            grupoSelect.required = false;
        }
    }

    document.addEventListener('DOMContentLoaded', mostrarGrupo);
</script>
@endsection
