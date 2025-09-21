@extends('layouts.form')

@section('titulo-formulario')
Crear Docente <i class="fas fa-chalkboard-teacher"></i>
@endsection

@section('id-form', 'formulario-docente')

@section('ruta-accion')
{{ route('docentes.store') }}
@endsection

@section('metodo')
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
                <option value="" disabled {{ old('id_tipo_documento') ? '' : 'selected' }}>Seleccione un tipo</option>
                @foreach($tipoDocumentos as $tipoDocumento)
                <option value="{{ $tipoDocumento->id }}" {{ old('id_tipo_documento') == $tipoDocumento->id ? 'selected' : '' }}>
                    {{ $tipoDocumento->descripcion }}
                </option>
                @endforeach
            </select>
            <label for="id_tipo_documento">Tipo de Documento</label>
        </div>
        @error('id_tipo_documento')
        <div class="text-danger mt-1 px-2 py-1" style="background-color:#ffe6e6; border-radius:4px;">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-md-3">
        <div class="form-floating">
            <input
                type="number"
                name="documento"
                id="documento"
                class="form-control @error('documento') is-invalid @enderror"
                value="{{ old('documento') }}"
                placeholder=" "
                required>
            <label for="documento">Documento del Docente</label>
        </div>
        @error('documento')
        <div class="text-danger mt-1 px-2 py-1" style="background-color:#ffe6e6; border-radius:4px;">{{ $message }}</div>
        @enderror
    </div>


    <div class="col-md-3">
        <div class="form-floating">
            <input
                type="text"
                name="primer_nombre"
                id="primer_nombre"
                class="form-control @error('primer_nombre') is-invalid @enderror"
                value="{{ old('primer_nombre') }}"
                placeholder=" "
                required>
            <label for="primer_nombre">Primer Nombre</label>
        </div>
        @error('primer_nombre')
        <div class="text-danger mt-1 px-2 py-1" style="background-color:#ffe6e6; border-radius:4px;">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-3">
        <div class="form-floating">
            <input
                type="text"
                name="segundo_nombre"
                id="segundo_nombre"
                class="form-control @error('segundo_nombre') is-invalid @enderror"
                value="{{ old('segundo_nombre') }}"
                placeholder=" ">
            <label for="segundo_nombre">Segundo Nombre</label>
        </div>
        @error('segundo_nombre')
        <div class="text-danger mt-1 px-2 py-1" style="background-color:#ffe6e6; border-radius:4px;">{{ $message }}</div>
        @enderror
    </div>

</div>

<div class="row mb-3">
    <div class="col-md-3">
        <div class="form-floating">
            <input
                type="text"
                name="primer_apellido"
                id="primer_apellido"
                class="form-control @error('primer_apellido') is-invalid @enderror"
                value="{{ old('primer_apellido') }}"
                placeholder=" "
                required>
            <label for="primer_apellido">Primer Apellido</label>
        </div>
        @error('primer_apellido')
        <div class="text-danger mt-1 px-2 py-1" style="background-color:#ffe6e6; border-radius:4px;">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-3">
        <div class="form-floating">
            <input
                type="text"
                name="segundo_apellido"
                id="segundo_apellido"
                class="form-control @error('segundo_apellido') is-invalid @enderror"
                value="{{ old('segundo_apellido') }}"
                placeholder=" ">
            <label for="segundo_apellido">Segundo Apellido</label>
        </div>
        @error('segundo_apellido')
        <div class="text-danger mt-1 px-2 py-1" style="background-color:#ffe6e6; border-radius:4px;">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-3">
        <div class="form-floating">
            <input
                type="email"
                name="correo_electronico"
                id="correo_electronico"
                class="form-control @error('correo_electronico') is-invalid @enderror"
                value="{{ old('correo_electronico') }}"
                placeholder=" "
                required>
            <label for="correo_electronico">Correo Electrónico</label>
        </div>
        @error('correo_electronico')
        <div class="text-danger mt-1 px-2 py-1" style="background-color:#ffe6e6; border-radius:4px;">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-3">
        <div class="form-floating mt-2">
            <select
                name="id_materia"
                id="id_materia"
                class="form-select @error('id_materia') is-invalid @enderror"
                required>
                <option value="" disabled {{ old('id_materia') ? '' : 'selected' }}>Seleccione una materia</option>
                @foreach($materias as $materia)
                <option value="{{ $materia->id }}" {{ old('id_materia') == $materia->id ? 'selected' : '' }}>
                    {{ $materia->descripcion }}
                </option>
                @endforeach
            </select>
            <label for="id_materia">Materia</label>
        </div>
        @error('id_materia')
        <div class="text-danger mt-1 px-2 py-1" style="background-color:#ffe6e6; border-radius:4px;">{{ $message }}</div>
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