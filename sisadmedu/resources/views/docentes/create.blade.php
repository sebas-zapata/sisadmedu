@extends('layouts.form')

@section('titulo-formulario')
Registrar Nuevo Docente <i class="fas fa-chalkboard-teacher"></i>
@endsection

@section('id-form', 'formulario-docente')
@section('ruta-accion')
{{ route('docentes.store') }}
@endsection
@section('metodo')
@method('POST')
@endsection

@section('campos-formulario')
<div class="row mb-3">
    <div class="col-md-3">
        <div class="form-floating">
            <input type="text" class="form-control" id="codigo_docente" name="codigo_docente" placeholder="Ej: DOC001" required value="{{ old('codigo_docente') }}">
            <label for="codigo_docente">Código del Docente</label>
        </div>
        @enderror
    </div>

    <div class="col-md-3">
        <div class="form-floating">
            <input type="text" class="form-control" id="documento" name="documento" placeholder="Ej: 12345678" required value="{{ old('documento') }}">
            <label for="documento">Documento del Docente</label>
        </div>
        @enderror
    </div>

    <div class="col-md-3">
        <div class="form-floating">
            <input type="text" class="form-control" id="primer_nombre" name="primer_nombre" placeholder="Ej: Ana" required value="{{ old('primer_nombre') }}">
            <label for="primer_nombre">Primer Nombre</label>
        </div>
        @enderror
    </div>

    <div class="col-md-3">
        <div class="form-floating">
            <input type="text" class="form-control" id="segundo_nombre" name="segundo_nombre" placeholder="Ej: María" value="{{ old('segundo_nombre') }}">
            <label for="segundo_nombre">Segundo Nombre</label>
        </div>
    </div>
</div>

<div class="row mb-3">
    <div class="col-md-3">
        <div class="form-floating">
            <input type="text" class="form-control" id="primer_apellido" name="primer_apellido" placeholder="Ej: Pérez" required value="{{ old('primer_apellido') }}">
            <label for="primer_apellido">Primer Apellido</label>
        </div>
        @enderror
    </div>

    <div class="col-md-3">
        <div class="form-floating">
            <input type="text" class="form-control" id="segundo_apellido" name="segundo_apellido" placeholder="Ej: Gómez" value="{{ old('segundo_apellido') }}">
            <label for="segundo_apellido">Segundo Apellido</label>
        </div>
        @enderror
    </div>

    <div class="col-md-3">
        <div class="form-floating">
            <input type="email" class="form-control" id="correo_electronico" name="correo_electronico" placeholder="Ej: ejemplo@correo.com" required value="{{ old('correo_electronico') }}">
            <label for="correo_electronico">Correo Electrónico</label>
        </div>
        @enderror
    </div>

    <div class="col-md-3">
        <div class="form-floating">
            <select class="form-select" id="id_materia" name="id_materia" required>
                <option value="" disabled {{ old('id_materia') ? '' : 'selected' }}>Seleccione una materia</option>
                @foreach ($materias as $materia)
                    <option value="{{ $materia->id }}" {{ old('id_materia') == $materia->id ? 'selected' : '' }}>
                        {{ $materia->descripcion }}
                    </option>
                @endforeach
            </select>
            <label for="id_materia">Materia</label>
        </div>
        @enderror
    </div>
</div> 
    <div class="row mb-3">
        <div class="col-md-3">
         <div class="form-floating">
            <select class="form-select" id="tipo_documento_id" name="tipo_documento_id" required>
                <option value="" disabled {{ old('tipo_documento_id') ? '' : 'selected' }}>Seleccione un tipo de documento</option>
                @foreach ($tipoDocumentos as $tipoDocumento)
                    <option value="{{ $tipoDocumento->id }}" {{ old('tipo_documento_id') == $tipoDocumento->id ? 'selected' : '' }}>
                        {{ $tipoDocumento->descripcion }}
                    </option>
                @endforeach
            </select>
            <label for="tipo_documento_id">Tipo de Documento</label>
        </div>
</div>
@section('botones-formulario')
        <x-boton-principal href="{{ route('docentes.index') }}">
            <i class="fas fa-arrow-left"></i> Cancelar
        </x-boton-principal>
        <x-boton-principal type="submit">
            <i class="fas fa-user-plus"></i> Guardar
        </x-boton-principal>
@endsection
