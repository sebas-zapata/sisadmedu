@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Editar Usuario</h1>
    
    @if ($errors->any())
    <div class="alert alert-danger">
        <strong>¡Error!</strong> Hay problemas con los datos ingresados.<br><br>
        <ul>
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
                <div class="form-group">
                    <label for="tipo_documento_codigo_tipo_documento">Tipo de Documento:</label>
                    <select class="form-control" id="tipo_documento_codigo_tipo_documento" name="tipo_documento_codigo_tipo_documento" required>
                        @foreach ($tiposDocumento as $tipoDocumento)
                        <option value="{{ $tipoDocumento->codigo_tipo_documento }}" {{ $usuario->tipo_documento_codigo_tipo_documento == $tipoDocumento->codigo_tipo_documento ? 'selected' : '' }}>
                            {{ $tipoDocumento->descripcion_tipo_documento }}
                        </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="documento_usuario">Número de Documento:</label>
                    <input type="number" name="documento_usuario" class="form-control" value="{{ $usuario->documento_usuario }}" required>
                </div>
            </div>
        </div>
        
        <div class="row mb-3">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="nombres_usuario">Nombres:</label>
                    <input type="text" name="nombres_usuario" class="form-control" value="{{ $usuario->nombres_usuario }}" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="apellidos_usuario">Apellidos:</label>
                    <input type="text" name="apellidos_usuario" class="form-control" value="{{ $usuario->apellidos_usuario }}" required>
                </div>
            </div>
        </div>
        
        <div class="row mb-3">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="telefono_usuario">Teléfono:</label>
                    <input type="text" name="telefono_usuario" class="form-control" value="{{ $usuario->telefono_usuario }}" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="correo_electronico_usuario">Correo Electrónico:</label>
                    <input type="email" name="correo_electronico_usuario" class="form-control" value="{{ $usuario->correo_electronico_usuario }}" required>
                </div>
            </div>
        </div>
        
        <div class="row mb-3">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="contrasena_usuario">Contraseña (dejar en blanco para mantener la actual):</label>
                    <input type="password" name="contrasena_usuario" class="form-control" placeholder="Ingrese nueva contraseña si desea cambiarla">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="rol_id_rol">Rol:</label>
                    <select class="form-control" id="rol_id_rol" name="rol_id_rol" required onchange="mostrarGrupo()">
                        @foreach ($roles as $rol)
                        <option value="{{ $rol->id_rol }}" {{ $usuario->rol_id_rol == $rol->id_rol ? 'selected' : '' }}>
                            {{ $rol->rol }}
                        </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        
        <div class="row mb-3" id="grupo_container" style="display: none;">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="grupo_id_grupo">Grupo:</label>
                    <select class="form-control" id="grupo_id_grupo" name="grupo_id_grupo">
                        <option value="">Seleccione un grupo</option>
                        @foreach ($grupos as $grupo)
                        <option value="{{ $grupo->id_grupo }}" {{ $usuario->grupo_id_grupo == $grupo->id_grupo ? 'selected' : '' }}>
                            {{ $grupo->nombre_grupo }}
                        </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Actualizar</button>
                <a class="btn btn-secondary" href="{{ route('usuarios.index') }}">Cancelar</a>
            </div>
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
    
    // Ejecutar al cargar la página
    document.addEventListener('DOMContentLoaded', function() {
        mostrarGrupo();
    });
</script>
@endsection