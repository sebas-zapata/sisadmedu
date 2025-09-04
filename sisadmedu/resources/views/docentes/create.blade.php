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
    <div class="col-md-3 mb-3">
        <input type="text" class="form-control @error('codigo_docente') is-invalid @enderror" id="codigo_docente" name="codigo_docente" placeholder="Código del Docente" required value="{{ old('codigo_docente') }}">
        @error('codigo_docente')
        <div class="text-danger mt-1 px-2 py-1" style="background-color: #ffe6e6; border-radius: 4px;">
            {{ $message }}
        </div>
        @enderror
    </div>

    <div class="col-md-3 mb-3">
        <input type="text" class="form-control @error('documento') is-invalid @enderror" id="documento" name="documento" placeholder="Documento del Docente" required value="{{ old('documento') }}">
        @error('documento')
        <div class="text-danger mt-1 px-2 py-1" style="background-color: #ffe6e6; border-radius: 4px;">
            {{ $message }}
        </div>
        @enderror
    </div>

    <div class="col-md-3 mb-3">
        <input type="text" class="form-control @error('primer_nombre') is-invalid @enderror" id="primer_nombre" name="primer_nombre" placeholder="Primer Nombre" required value="{{ old('primer_nombre') }}">
        @error('primer_nombre')
        <div class="text-danger mt-1 px-2 py-1" style="background-color: #ffe6e6; border-radius: 4px;">
            {{ $message }}
        </div>
        @enderror
    </div>

    <div class="col-md-3 mb-3">
        <input type="text" class="form-control @error('segundo_nombre') is-invalid @enderror" id="segundo_nombre" name="segundo_nombre" placeholder="Segundo Nombre" value="{{ old('segundo_nombre') }}">
        @error('segundo_nombre')
        <div class="text-danger mt-1 px-2 py-1" style="background-color: #ffe6e6; border-radius: 4px;">
            {{ $message }}
        </div>
        @enderror
    </div>
</div>

<div class="row mb-3">
    <div class="col-md-3 mb-3">
        <input type="text" class="form-control @error('primer_apellido') is-invalid @enderror" id="primer_apellido" name="primer_apellido" placeholder="Primer Apellido" required value="{{ old('primer_apellido') }}">
        @error('primer_apellido')
        <div class="text-danger mt-1 px-2 py-1" style="background-color: #ffe6e6; border-radius: 4px;">
            {{ $message }}
        </div>
        @enderror
    </div>

    <div class="col-md-3 mb-3">
        <input type="text" class="form-control @error('segundo_apellido') is-invalid @enderror" id="segundo_apellido" name="segundo_apellido" placeholder="Segundo Apellido" value="{{ old('segundo_apellido') }}">
        @error('segundo_apellido')
        <div class="text-danger mt-1 px-2 py-1" style="background-color: #ffe6e6; border-radius: 4px;">
            {{ $message }}
        </div>
        @enderror
    </div>

    <div class="col-md-3 mb-3">
        <input type="email" class="form-control @error('correo_electronico') is-invalid @enderror" id="correo_electronico" name="correo_electronico" placeholder="Correo Electrónico" required value="{{ old('correo_electronico') }}">
        @error('correo_electronico')
        <div class="text-danger mt-1 px-2 py-1" style="background-color: #ffe6e6; border-radius: 4px;">
            {{ $message }}
        </div>
        @enderror
    </div>

    <div class="col-md-3 mb-3 mt-2">
        <select class="form-select @error('id_materia') is-invalid @enderror" id="id_materia" name="id_materia" required>
            <option value="" disabled {{ old('id_materia') ? '' : 'selected' }}>Seleccione una materia</option>
            @foreach ($materias as $materia)
                <option value="{{ $materia->id }}" {{ old('id_materia') == $materia->id ? 'selected' : '' }}>
                    {{ $materia->descripcion }}
                </option>
            @endforeach
        </select>
        @error('id_materia')
        <div class="text-danger mt-1 px-2 py-1" style="background-color: #ffe6e6; border-radius: 4px;">
            {{ $message }}
        </div>
        @enderror
    </div>
</div>

<div class="row mb-3">
    <div class="col-md-3 mb-3">
        <select class="form-select @error('id_tipo_documento') is-invalid @enderror" id="id_tipo_documento" name="id_tipo_documento" required>
            <option value="" disabled {{ old('id_tipo_documento') ? '' : 'selected' }}>Seleccione un tipo de documento</option>
            @foreach ($tipoDocumentos as $tipoDocumento)
                <option value="{{ $tipoDocumento->id }}" {{ old('id_tipo_documento') == $tipoDocumento->id ? 'selected' : '' }}>
                    {{ $tipoDocumento->descripcion }}
                </option>
            @endforeach
        </select>
        @error('id_tipo_documento')
        <div class="text-danger mt-1 px-2 py-1" style="background-color: #ffe6e6; border-radius: 4px;">
            {{ $message }}
        </div>
        @enderror
    </div>
</div>

<div></div>
@endsection

@section('botones-formulario')
    <x-boton-principal href="{{ route('docentes.index') }}">
        <i class="fas fa-arrow-left"></i> Cancelar
    </x-boton-principal>
    <x-boton-principal type="submit">
        <i class="fas fa-user-plus"></i> Guardar
    </x-boton-principal>
@endsection
