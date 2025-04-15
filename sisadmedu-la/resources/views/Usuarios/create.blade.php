<!-- resources/views/usuarios/create.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Crear Nuevo Usuario</h1>
    
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
    
    <form action="{{ route('usuarios.store') }}" method="POST">
        @csrf
        
        <div class="row mb-3">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="tipo_documento_codigo_tipo_documento">Tipo de Documento:</label>
                    <select class="form-control" id="tipo_documento_codigo_tipo_documento" name="tipo_documento_codigo_tipo_documento" required>
                        <option value="">Seleccione un tipo de documento</option>
                        @foreach ($tiposDocumento as $tipoDocumento)
                        <option value="{{ $tipoDocumento->codigo_tipo_documento }}">{{ $tipoDocumento->descripcion_tipo_documento }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="documento_usuario">Número de Documento:</label>
                    <input type="number" name="documento_usuario" class="form-control" placeholder="Ingrese el número de documento" required>
                </div>
            </div>
        </div>
        
        <div class="row mb-3">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="nombres_usuario">Nombres:</label>
                    <input type="text" name="nombres_usuario" class="form-control" placeholder="Ingrese nombres" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="apellidos_usuario">Apellidos:</label>
                    <input type="text" name="apellidos_usuario" class="form-control" placeholder="Ingrese apellidos" required>
                </div>
            </div>
        </div>
        
        <div class="row mb-3">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="telefono_usuario">Teléfono:</label>
                    <input type="text" name="telefono_usuario" class="form-control" placeholder="Ingrese teléfono" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="correo_electronico_usuario">Correo Electrónico:</label>
                    <input type="email" name="correo_electronico_usuario" class="form-control" placeholder="Ingrese correo electrónico" required>
                </div>
            </div>
        </div>
        
        <div class="row mb-3">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="contrasena_usuario">Contraseña:</label>
                    <input type="password" name="contrasena_usuario" class="form-control" placeholder="Ingrese contraseña" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="rol_id_rol">Rol:</label>
                    <select class="form-control" id="rol_id_rol" name="rol_id_rol" required onchange="mostrarGrupo()">
                        <option value="">Seleccione un rol</option>
                        @foreach ($roles as $rol)
                        <option value="{{ $rol->id_rol }}">{{ $rol->rol }}</option>
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
                        <option value="{{ $grupo->id_grupo }}">{{ $grupo->nombre_grupo }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Guardar</button>
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
</script>
@endsection