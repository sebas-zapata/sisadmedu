@extends('layouts.form')

@section('titulo-formulario')
Registrar nueva Asignación <i class="fas fa-plus-circle"></i>
@endsection

@section('id-form', 'formulario-asignacion')

@section('ruta-accion')
{{ route('asignaciones.store') }}
@endsection

@section('metodo')
@csrf
@endsection

@section('campos-formulario')
<div class="row mb-3">

    {{-- Docente --}}
    <div class="col-12 col-md-4 mb-3">
        <div class="form-floating">
            <select name="docente_id" id="docente_id"
                class="form-select @error('docente_id') is-invalid @enderror"
                required>
                <option value="">Seleccione un docente</option>
                @foreach ($docentes as $docente)
                    <option value="{{ $docente->id }}" {{ old('docente_id') == $docente->id ? 'selected' : '' }}>
                        {{ $docente->primer_nombre }} {{ $docente->primer_apellido }}
                    </option>
                @endforeach
            </select>
            <label for="docente_id">Docente</label>
            @error('docente_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    {{-- Grado --}}
    <div class="col-12 col-md-4 mb-3">
        <div class="form-floating">
            <select name="grado_id" id="grado_id"
                class="form-select @error('grado_id') is-invalid @enderror"
                required>
                <option value="">Seleccione un grado</option>
                @foreach ($grados as $grado)
                    <option value="{{ $grado->id }}" {{ old('grado_id') == $grado->id ? 'selected' : '' }}>
                        {{ $grado->nombre_grado }}
                    </option>
                @endforeach
            </select>
            <label for="grado_id">Grado</label>
            @error('grado_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    {{-- Materia --}}
    <div class="col-12 col-md-4 mb-3">
        <div class="form-floating">
            <select name="materia_id" id="materia_id"
                class="form-select @error('materia_id') is-invalid @enderror"
                required>
                <option value="">Seleccione una materia</option>
                @foreach ($materias as $materia)
                    <option value="{{ $materia->id }}" {{ old('materia_id') == $materia->id ? 'selected' : '' }}>
                        {{ $materia->descripcion }}
                    </option>
                @endforeach
            </select>
            <label for="materia_id">Materia</label>
            @error('materia_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

</div>

{{-- Botones --}}
<div class="d-flex justify-content-end mt-3">
    <a href="{{ route('asignaciones.index') }}" class="btn btn-secondary me-2">
        <i class="fas fa-arrow-left"></i> Cancelar
    </a>
    <button type="submit" class="btn btn-success">
        <i class="fas fa-save"></i> Guardar
    </button>
</div>
@endsection
