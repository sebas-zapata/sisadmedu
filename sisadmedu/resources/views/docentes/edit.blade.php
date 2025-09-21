@extends('layouts.form')

@section('titulo-formulario')
Editar Docente <i class="fas fa-chalkboard-teacher"></i>
@endsection

@section('id-form', 'formulario-docente')

@section('ruta-accion')
{{ route('docentes.update', $docente->id) }}
@endsection

@section('metodo')
@method('PUT')
@csrf
@endsection

@section('campos-formulario')
<div class="row mb-3">
    <div class="col-md-3">
        <div class="form-floating mt-2">
            <select
                name="id_tipo_documento"
                id="id_tipo_documento"
                class="form-select @error('id_tipo_documento') is-invalid @enderror"
                required>
                <option value="" disabled {{ old('id_tipo_documento', $docente->id_tipo_documento) ? '' : 'selected' }}>
                    Seleccione un tipo
                </option>
                @foreach($documentos as $tipoDocumento)
                <option
                    value="{{ $tipoDocumento->id }}"
                    {{ old('id_tipo_documento', $docente->id_tipo_documento) == $tipoDocumento->id ? 'selected' : '' }}>
                    {{ $tipoDocumento->descripcion }}
                </option>
                @endforeach
            </select>
            <label for="id_tipo_documento">Tipo de Documento</label>
        </div>
        @error('id_tipo_documento')
        <div class="text-danger mt-1 px-2 py-1" style="background-color:#ffe6e6; border-radius:4px;">
            {{ $message }}
        </div>
        @enderror
    </div>
    <div class="col-md-3">
        <div class="form-floating">
            <input
                type="text"
                class="form-control @error('documento') is-invalid @enderror"
                id="documento"
                name="documento"
                placeholder="Ej: DOC001"
                required
                value="{{ old('documento', $docente->documento) }}">
            <label for="documento">Documento del Docente</label>
        </div>
        @error('documento')
        <div class="text-danger mt-1 px-2 py-1" style="background-color:#ffe6e6; border-radius:4px;">
            {{ $message }}
        </div>
        @enderror
    </div>



    <div class="col-md-3">
        <div class="form-floating">
            <input
                type="text"
                class="form-control @error('primer_nombre') is-invalid @enderror"
                id="primer_nombre"
                name="primer_nombre"
                placeholder="Ej: Ana"
                required
                value="{{ old('primer_nombre', $docente->primer_nombre) }}">
            <label for="primer_nombre">Primer Nombre</label>
        </div>
        @error('primer_nombre')
        <div class="text-danger mt-1 px-2 py-1" style="background-color:#ffe6e6; border-radius:4px;">
            {{ $message }}
        </div>
        @enderror
    </div>

    <div class="col-md-3">
        <div class="form-floating">
            <input
                type="text"
                class="form-control @error('segundo_nombre') is-invalid @enderror"
                id="segundo_nombre"
                name="segundo_nombre"
                placeholder="Ej: María"
                value="{{ old('segundo_nombre', $docente->segundo_nombre) }}">
            <label for="segundo_nombre">Segundo Nombre</label>
        </div>
        @error('segundo_nombre')
        <div class="text-danger mt-1 px-2 py-1" style="background-color:#ffe6e6; border-radius:4px;">
            {{ $message }}
        </div>
        @enderror
    </div>
</div>

<div class="row mb-3">
    <div class="col-md-3">
        <div class="form-floating">
            <input
                type="text"
                class="form-control @error('primer_apellido') is-invalid @enderror"
                id="primer_apellido"
                name="primer_apellido"
                placeholder="Ej: Pérez"
                required
                value="{{ old('primer_apellido', $docente->primer_apellido) }}">
            <label for="primer_apellido">Primer Apellido</label>
        </div>
        @error('primer_apellido')
        <div class="text-danger mt-1 px-2 py-1" style="background-color:#ffe6e6; border-radius:4px;">
            {{ $message }}
        </div>
        @enderror
    </div>

    <div class="col-md-3">
        <div class="form-floating">
            <input
                type="text"
                class="form-control @error('segundo_apellido') is-invalid @enderror"
                id="segundo_apellido"
                name="segundo_apellido"
                placeholder="Ej: Gómez"
                value="{{ old('segundo_apellido', $docente->segundo_apellido) }}">
            <label for="segundo_apellido">Segundo Apellido</label>
        </div>
        @error('segundo_apellido')
        <div class="text-danger mt-1 px-2 py-1" style="background-color:#ffe6e6; border-radius:4px;">
            {{ $message }}
        </div>
        @enderror
    </div>

    <div class="col-md-3">
        <div class="form-floating">
            <input
                type="email"
                class="form-control @error('correo_electronico') is-invalid @enderror"
                id="correo_electronico"
                name="correo_electronico"
                placeholder="Ej: ejemplo@correo.com"
                required
                value="{{ old('correo_electronico', $docente->correo_electronico) }}">
            <label for="correo_electronico">Correo Electrónico</label>
        </div>
        @error('correo_electronico')
        <div class="text-danger mt-1 px-2 py-1" style="background-color:#ffe6e6; border-radius:4px;">
            {{ $message }}
        </div>
        @enderror
    </div>

    <div class="col-md-3">
        <div class="form-floating mt-2">
            <select
                class="form-select @error('id_materia') is-invalid @enderror"
                id="id_materia"
                name="id_materia"
                required>
                <option value="" disabled {{ old('id_materia', $docente->id_materia) ? '' : 'selected' }}>Seleccione una materia</option>
                @foreach ($materias as $materia)
                <option value="{{ $materia->id }}" {{ old('id_materia', $docente->id_materia) == $materia->id ? 'selected' : '' }}>
                    {{ $materia->descripcion }}
                </option>
                @endforeach
            </select>
            <label for="id_materia">Materia</label>
        </div>
        @error('id_materia')
        <div class="text-danger mt-1 px-2 py-1" style="background-color:#ffe6e6; border-radius:4px;">
            {{ $message }}
        </div>
        @enderror
    </div>
</div>

@endsection

@section('botones-formulario')
<x-boton-principal href="{{ route('docentes.index') }}">
    <i class="fas fa-arrow-left"></i> Cancelar
</x-boton-principal>
<x-boton-principal type="submit">
    <i class="fas fa-save"></i> Guardar
</x-boton-principal>
@endsection