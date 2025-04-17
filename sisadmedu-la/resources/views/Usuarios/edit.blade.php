@extends('layouts.app')

@section('content')
<div class="form-container">
    <h1 class="form-title">Editar Usuario</h1>

    @if ($errors->any())
    <div class="alert-error">
        <strong>¡Error!</strong> Hay problemas con los datos ingresados.
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('usuarios.update', $usuario->id_usuario) }}" method="POST" class="custom-form">
        @csrf
        @method('PUT')

        <div class="form-row">
            <div class="form-group">
                <label for="tipo_documento_codigo_tipo_documento">Tipo de Documento</label>
                <select id="tipo_documento_codigo_tipo_documento" name="tipo_documento_codigo_tipo_documento" required>
                    <option value="">Seleccione un tipo de documento</option>
                    @foreach ($tiposDocumento as $tipoDocumento)
                    <option value="{{ $tipoDocumento->codigo_tipo_documento }}" 
                        {{ $usuario->tipo_documento_codigo_tipo_documento == $tipoDocumento->codigo_tipo_documento ? 'selected' : '' }}>
                        {{ $tipoDocumento->descripcion_tipo_documento }}
                    </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="documento_usuario">Número de Documento</label>
                <input type="number" name="documento_usuario" value="{{ $usuario->documento_usuario }}" required>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="nombres_usuario">Nombres</label>
                <input type="text" name="nombres_usuario" value="{{ $usuario->nombres_usuario }}" required>
            </div>
            <div class="form-group">
                <label for="apellidos_usuario">Apellidos</label>
                <input type="text" name="apellidos_usuario" value="{{ $usuario->apellidos_usuario }}" required>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="telefono_usuario">Teléfono</label>
                <input type="text" name="telefono_usuario" value="{{ $usuario->telefono_usuario }}" required>
            </div>
            <div class="form-group">
                <label for="correo_electronico_usuario">Correo Electrónico</label>
                <input type="email" name="correo_electronico_usuario" value="{{ $usuario->correo_electronico_usuario }}" required>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="contrasena_usuario">Contraseña</label>
                <input type="password" name="contrasena_usuario" placeholder="Ingrese nueva contraseña (opcional)">
            </div>
            <div class="form-group">
                <label for="rol_id_rol">Rol</label>
                <select id="rol_id_rol" name="rol_id_rol" required onchange="mostrarGrupo()">
                    <option value="">Seleccione un rol</option>
                    @foreach ($roles as $rol)
                    <option value="{{ $rol->id_rol }}" {{ $usuario->rol_id_rol == $rol->id_rol ? 'selected' : '' }}>
                        {{ $rol->rol }}
                    </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-row" id="grupo_container" style="{{ $usuario->rol->rol == 'Estudiante' ? '' : 'display: none;' }}">
            <div class="form-group">
                <label for="grupo_id_grupo">Grupo</label>
                <select id="grupo_id_grupo" name="grupo_id_grupo" {{ $usuario->rol->rol == 'Estudiante' ? 'required' : '' }}>
                    <option value="">Seleccione un grupo</option>
                    @foreach ($grupos as $grupo)
                    <option value="{{ $grupo->id_grupo }}" {{ $usuario->grupo_id_grupo == $grupo->id_grupo ? 'selected' : '' }}>
                        {{ $grupo->nombre_grupo }}
                    </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn-guardar"><i class="fas fa-save"></i> Actualizar</button>
            <a href="{{ route('usuarios.index') }}" class="btn-cancelar"><i class="fas fa-arrow-left"></i> Cancelar</a>
        </div>
    </form>
</div>

<script>
    function mostrarGrupo() {
        var rolSeleccionado = document.getElementById('rol_id_rol').value;
        var rolEstudiante = @json(App\Models\Rol::where('rol', 'Estudiante')->first()->id_rol ?? 0);

        if (rolSeleccionado == rolEstudiante) {
            document.getElementById('grupo_container').style.display = 'block';
            document.getElementById('grupo_id_grupo').required = true;
        } else {
            document.getElementById('grupo_container').style.display = 'none';
            document.getElementById('grupo_id_grupo').required = false;
        }
    }
</script>
@endsection
