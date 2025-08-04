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
            <input type="text" class="form-control" id="codigo_estudiante" name="codigo_estudiante" placeholder="Ej: EST001" required value="{{ old('codigo_estudiante') }}">
            <label for="codigo_estudiante">Código del Estudiante</label>
        </div>
    </div>

    <div class="col-md-3">
        <div class="form-floating">
            <input type="text" class="form-control" id="documento_estudiante" name="documento_estudiante" placeholder="Ej: 123456789" required value="{{ old('documento_estudiante') }}">
            <label for="documento_estudiante">Documento del Estudiante</label>
        </div>
    </div>

    <div class="col-md-3">
        <div class="form-floating">
            <input type="text" class="form-control" id="primer_nombre" name="primer_nombre" placeholder="Ej: Juan" required value="{{ old('primer_nombre') }}">
            <label for="primer_nombre">Primer Nombre</label>
        </div>
    </div>

    <div class="col-md-3">
        <div class="form-floating">
            <input type="text" class="form-control" id="segundo_nombre" name="segundo_nombre" placeholder="Ej: Carlos" value="{{ old('segundo_nombre') }}">
            <label for="segundo_nombre">Segundo Nombre</label>
        </div>
    </div>

</div>
<div class="row mb-3">
    <div class="col-md-3">
        <div class="form-floating">
            <input type="text" class="form-control" id="primer_apellido" name="primer_apellido" placeholder="Ej: López" required value="{{ old('primer_apellido') }}">
            <label for="primer_apellido">Primer Apellido</label>
        </div>
    </div>

    <div class="col-md-3">
        <div class="form-floating">
            <input type="text" class="form-control" id="segundo_apellido" name="segundo_apellido" placeholder="Ej: Martínez" value="{{ old('segundo_apellido') }}">
            <label for="segundo_apellido">Segundo Apellido</label>
        </div>
    </div>

    <div class="col-md-3">
        <div class="form-floating">
            <input type="text" class="form-control" id="edad" name="edad" placeholder="Ej: 20" required value="{{ old('edad') }}">
            <label for="edad">Edad del estudiante</label>
        </div>
    </div>

    <div class="col-md-3">
        <div class="form-floating">
            <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" placeholder="Ej: 2003-05-15" required value="{{ old('fecha_nacimiento') }}">
            <label for="fecha_nacimiento">Fecha de nacimiento</label>
        </div>
    </div>

</div>
<div class="row mb-3">
        <div class="col-md-3">
        <div class="form-floating">
            <input type="text" class="form-control" id="celular_estudiante" name="celular_estudiante" placeholder="Ej: 3001234567" required value="{{ old('celular') }}">
            <label for="celular">Celular del estudiante</label>
        </div>
    </div>


    <div class="col-md-3">
        <div class="form-floating">
            <input type="email" class="form-control" id="correo_electronico" name="correo_electronico" placeholder="Ej: juan.lopez@example.com" required value="{{ old('correo_electronico') }}">
            <label for="correo_electronico">Correo Electrónico</label>
        </div>
    </div>

    <div class="col-md-3">
        <div class="form-floating">
            <input type="text" class="form-control" id="telefono" name="telefono" placeholder="Ej: 123456789" required value="{{ old('telefono') }}">
            <label for="telefono">Teléfono del estudiante</label>
        </div>
    </div>

    <div class="col-md-3">
        <div class="form-floating">
            <input type="text" class="form-control" id="direccion" name="direccion" placeholder="Ej: Calle Falsa 123" required value="{{ old('direccion') }}">
            <label for="direccion">Dirección del estudiante</label>
        </div>
    </div>
</div>
<div class="row mb-3">
    <div class="col-md-3 mb-3">
        <div class="form-floating">
            <select name="id_grado" class="form-select" id="id_grado" required>
                <option value="" disabled {{ old('id_grado') ? '' : 'selected' }}>Selecciona un grado</option>
                @foreach($grados as $grado)
                    <option value="{{ $grado->id }}" {{ old('id_grado') == $grado->id ? 'selected' : '' }}>
                        {{ $grado->nombre }}
                    </option>
                @endforeach
            </select>
            <label for="id_grado">Grado</label>
        </div>
    </div>

    <div class="col-md-4 mb-3">
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
    @section('botones-formulario')
            <x-boton-principal href="{{ route('estudiantes.index') }}">
            <i class="fas fa-arrow-left"></i> Cancelar
        </x-boton-principal>
        <x-boton-principal type="submit">
            <i class="fas fa-user-plus"></i> Guardar
        </x-boton-principal>
    @endsection
@endsection