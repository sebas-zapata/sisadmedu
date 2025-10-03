@extends('layouts.form')

@section('titulo-formulario')
<i class="fas fa-book"></i> Nueva Materia
@endsection

@section('id-form', 'formulario-materia')

@section('ruta-accion', route('materias.store'))

@section('metodo')
@method('POST')
@endsection

@section('campos-formulario')
<div class="row justify-content-center mb-3">
    <div class="col-md-8 mb-3">
        <div class="form-floating mb-3">
            <input type="text"
                name="descripcion"
                id="descripcion"
                class="form-control @error('descripcion') is-invalid @enderror"
                placeholder="Descripción de la materia"
                value="{{ old('descripcion') }}"
                required>
            <label for="descripcion">Descripción de la materia</label>
            @error('descripcion')
            <div class="text-danger mt-1 px-2 py-1" style="background-color: #ffe6e6; border-radius: 4px;">
                {{ $message }}
            </div>
            @enderror
        </div>
    </div>
</div>
@endsection

@section('botones-formulario')
<x-boton-principal href="{{ route('materias.index') }}">
    <i class="fas fa-arrow-left"></i> Cancelar
</x-boton-principal>

<x-boton-principal type="submit">
    <i class="fas fa-save"></i> Guardar
</x-boton-principal>
@endsection