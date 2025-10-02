@extends('layouts.form')

@section('titulo-formulario')
Editar Materia 
@endsection

@section('id-form', 'formulario-materia')

@section('ruta-accion', route('materias.update', $materia))

@section('metodo')
    @method('PUT')
@endsection

@section('campos-formulario')
<div class="row justify-content-center mb-3">
    <!-- Campo descripción -->
    <div class="col-md-6 mb-3">
        <div class="form-floating mb-3">
    <input type="text" 
           name="descripcion" 
           id="descripcion"
           class="form-control @error('descripcion') is-invalid @enderror"
           value="{{ old('descripcion', $materia->descripcion) }}" 
           placeholder="Nombre de la materia"
           required>
    <label for="descripcion">Nombre de la materia</label>
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
        <i class="fas fa-save"></i> Actualizar
    </x-boton-principal>
@endsection
