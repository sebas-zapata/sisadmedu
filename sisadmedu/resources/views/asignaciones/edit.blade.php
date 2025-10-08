@extends('layouts.form')

@section('titulo-formulario')
Editar Asignación <i class="fas fa-pen"></i>
@endsection

@section('id-form', 'formulario-asignacion')

@section('ruta-accion')
{{ route('asignaciones.update', $asignacion->id) }}
@endsection

@section('metodo')
@method('PUT')
@csrf
@endsection

@section('campos-formulario')
<div class="row mb-3">

    <!-- Docente -->
    <div class="col-12 col-md-4 mb-3 mb-md-0">
        <div class="form-floating mt-2">
            <select
                name="docente_id"
                id="docente_id"
                class="form-select @error('docente_id') is-invalid @enderror"
                required>
                <option value="" disabled>Seleccione un docente</option>
                @foreach($docentes as $docente)
                    <option value="{{ $docente->id }}" {{ old('docente_id', $asignacion->docente_id) == $docente->id ? 'selected' : '' }}>
                        {{ $docente->primer_nombre }} {{ $docente->primer_apellido }}
                    </option>
                @endforeach
            </select>
            <label for="docente_id">Docente</label>
        </div>
        @error('docente_id')
        <div class="text-danger mt-1 px-2 py-1" style="background-color:#ffe6e6; border-radius:4px;">
            {{ $message }}
        </div>
        @enderror
    </div>

    <!-- Materia -->
    <div class="col-12 col-md-4 mb-3 mb-md-0">
        <div class="form-floating mt-2">
            <select
                name="materia_id"
                id="materia_id"
                class="form-select @error('materia_id') is-invalid @enderror"
                required>
                <option value="" disabled>Seleccione una materia</option>
                @foreach($materias as $materia)
                    <option value="{{ $materia->id }}" {{ old('materia_id', $asignacion->materia_id) == $materia->id ? 'selected' : '' }}>
                        {{ $materia->descripcion }}
                    </option>
                @endforeach
            </select>
            <label for="materia_id">Materia</label>
        </div>
        @error('materia_id')
        <div class="text-danger mt-1 px-2 py-1" style="background-color:#ffe6e6; border-radius:4px;">
            {{ $message }}
        </div>
        @enderror
    </div>

    <!-- Grado -->
    <div class="col-12 col-md-4 mb-3 mb-md-0">
        <div class="form-floating mt-2">
            <select
                name="grado_id"
                id="grado_id"
                class="form-select @error('grado_id') is-invalid @enderror"
                required>
                <option value="" disabled>Seleccione un grado</option>
                @foreach($grados as $grado)
                    <option value="{{ $grado->id }}" {{ old('grado_id', $asignacion->grado_id) == $grado->id ? 'selected' : '' }}>
                        {{ $grado->nombre_grado }}
                    </option>
                @endforeach
            </select>
            <label for="grado_id">Grado</label>
        </div>
        @error('grado_id')
        <div class="text-danger mt-1 px-2 py-1" style="background-color:#ffe6e6; border-radius:4px;">
            {{ $message }}
        </div>
        @enderror
    </div>

</div>
@endsection

@section('botones-formulario')
<x-boton-principal href="{{ route('asignaciones.index') }}">
    <i class="fas fa-arrow-left"></i> Cancelar
</x-boton-principal>
<x-boton-principal type="submit" color="primary">
    <i class="fas fa-save"></i> Guardar Cambios
</x-boton-principal>
@endsection
