@extends('layouts.form')
@section('titulo-formulario')
Crear Estudiante <i class="fas fa-user-graduate"></i>
@endsection
@section('id-form', 'formulario-estudiante')
@section('ruta-accion')
{{ route('estudiantes.store') }}
@endsection
@section('metodo')
@method('POST')
@endsection
@section('campos-formulario')
<div class="row mb-3">
    <div class="col-md-3">
        <div class="form-floating">
            <input type="text" class="form-control" id="codigo_estudiante" name="codigo_estudiante" required value="{{ old('codigo_estudiante') }}">
            <label for="codigo_estudiante">Código del Estudiante</label>
        </div>
    </div>

    <div class="col-md-3">
        <div class="form-floating">
            <input type="text" class="form-control" id="id_documento_estudiante" name="id_documento_estudiante"  required value="{{ old('id_documento_estudiante') }}">
            <label for="id_documento_estudiante">Documento del Estudiante</label>
        </div>
    </div>

    <div class="col-md-3">
        <div class="form-floating">
            <input type="text" class="form-control" id="primer_nombre_estudiante" name="primer_nombre_estudiante"  required value="{{ old('primer_nombre_estudiante') }}">
            <label for="primer_nombre_estudiante">Primer Nombre</label>
        </div>
    </div>

    <div class="col-md-3">
        <div class="form-floating">
            <input type="text" class="form-control" id="segundo_nombre_estudiante" name="segundo_nombre_estudiante"  value="{{ old('segundo_nombre_estudiante') }}">
            <label for="segundo_nombre_estudiante">Segundo Nombre</label>
        </div>
    </div>
</div>

<div class="row mb-3">
    <div class="col-md-3">
        <div class="form-floating">
            <input type="text" class="form-control" id="primer_apellido_estudiante" name="primer_apellido_estudiante"  required value="{{ old('primer_apellido_estudiante') }}">
            <label for="primer_apellido_estudiante">Primer Apellido</label>
        </div>
    </div>

    <div class="col-md-3">
        <div class="form-floating">
            <input type="text" class="form-control" id="segundo_apellido_estudiante" name="segundo_apellido_estudiante" value="{{ old('segundo_apellido_estudiante') }}">
            <label for="segundo_apellido_estudiante">Segundo Apellido</label>
        </div>
    </div>

    <div class="col-md-3">
        <div class="form-floating">
            <input type="number" class="form-control" id="edad_estudiante" name="edad_estudiante" required value="{{ old('edad_estudiante') }}">
            <label for="edad_estudiante">Edad</label>
        </div>
    </div>

    <div class="col-md-3">
        <div class="form-floating">
            <input type="date" class="form-control" id="fecha_nacimiento_estudiante" name="fecha_nacimiento_estudiante" required value="{{ old('fecha_nacimiento_estudiante') }}">
            <label for="fecha_nacimiento_estudiante">Fecha de nacimiento</label>
        </div>
    </div>
</div>

<div class="row mb-3">
    <div class="col-md-3">
        <div class="form-floating">
            <input type="text" class="form-control" id="celular_estudiante" name="celular_estudiante"  value="{{ old('celular_estudiante') }}">
            <label for="celular_estudiante">Celular</label>
        </div>
    </div>

    <div class="col-md-3">
        <div class="form-floating">
            <input type="text" class="form-control" id="telefono_estudiante" name="telefono_estudiante" value="{{ old('telefono_estudiante') }}">
            <label for="telefono_estudiante">Teléfono</label>
        </div>
    </div>

    <div class="col-md-3">
        <div class="form-floating">
            <input type="email" class="form-control" id="correo_electronico_estudiante" name="correo_electronico_estudiante" value="{{ old('correo_electronico_estudiante') }}">
            <label for="correo_electronico_estudiante">Correo Electrónico</label>
        </div>
    </div>

    <div class="col-md-3">
        <div class="form-floating">
            <input type="text" class="form-control" id="direccion_estudiante" name="direccion_estudiante" value="{{ old('direccion_estudiante') }}">
            <label for="direccion_estudiante">Dirección</label>
        </div>
    </div>
</div>

<div class="row mb-3">
    <div class="col-md-3">
        <div class="form-floating">
            <select name="id_grado" class="form-select" id="id_grado" required>
                <option value="" disabled {{ old('id_grado') ? '' : 'selected' }}>Selecciona un grado</option>
                @foreach($grados as $grado)
                    <option value="{{ $grado->id }}" {{ old('id_grado') == $grado->id ? 'selected' : '' }}>
                        {{ $grado->nombre_grado }}
                    </option>
                @endforeach
            </select>
            <label for="id_grado">Grado</label>
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-floating">
            <select name="id_tipo_documento" class="form-select" id="id_tipo_documento" required>
                <option value="" disabled {{ old('id_tipo_documento') ? '' : 'selected' }}>Selecciona un tipo de documento</option>
                @foreach($tiposDocumentos as $tipo)
                    <option value="{{ $tipo->id }}" {{ old('id_tipo_documento') == $tipo->id ? 'selected' : '' }}>
                        {{ $tipo->descripcion }}
                    </option>
                @endforeach
            </select>
            <label for="id_tipo_documento">Tipo de Documento</label>
        </div>
    </div>
</div>

@section('botones-formulario')
    <x-boton-principal href="{{ route('estudiantes.index') }}">
        <i class="fas fa-arrow-left"></i> Cancelar
    </x-boton-principal>
    <x-boton-principal type="submit">
        <i class="fas fa-user-plus"></i> Guardar
    </x-boton-principal>
@endsection
@endsection
