@extends('layouts.form')

@section('titulo-formulario')
Editar Grado <i class="fas fa-edit"></i>
@endsection

@section('id-form', 'formulario-grado')

@section('ruta-accion', route('grados.update', $grado))

@section('metodo')
    @method('PUT')
@endsection

@section('campos-formulario')
<div class="row justify-content-center mb-3">
    <div class="col-md-6 mb-3">
        <label for="nivel_grado" class="form-label">Nivel</label>
        <select name="nivel_grado" id="nivel_grado"
            class="form-control @error('nivel_grado') is-invalid @enderror" required>
            <option value="">-- Seleccione un nivel --</option>
            @for ($i = 1; $i <= 11; $i++)
                <option value="{{ $i }}"
                    {{ old('nivel_grado', $grado->nivel_grado) == $i ? 'selected' : '' }}>
                    {{ $i }}
                </option>
            @endfor
        </select>
        @error('nivel_grado')
            <div class="text-danger mt-1 px-2 py-1" style="background-color: #ffe6e6; border-radius: 4px;">
                {{ $message }}
            </div>
        @enderror
    </div>

    <div class="col-md-6 mb-3">
        <label for="grupo_grado" class="form-label">Grupo</label>
        <select name="grupo_grado" id="grupo_grado"
            class="form-control @error('grupo_grado') is-invalid @enderror" required>
            <option value="">-- Seleccione un grupo --</option>
            @for ($i = 1; $i <= 5; $i++)
                <option value="{{ $i }}"
                    {{ old('grupo_grado', $grado->grupo_grado) == $i ? 'selected' : '' }}>
                    {{ $i }}
                </option>
            @endfor
        </select>
        @error('grupo_grado')
            <div class="text-danger mt-1 px-2 py-1" style="background-color: #ffe6e6; border-radius: 4px;">
                {{ $message }}
            </div>
        @enderror
    </div>
</div>
@endsection

@section('botones-formulario')
    <x-boton-principal href="{{ route('grados.index') }}">
        <i class="fas fa-arrow-left"></i> Cancelar
    </x-boton-principal>
    <x-boton-principal type="submit">
        <i class="fas fa-save"></i> Actualizar
    </x-boton-principal>
@endsection
