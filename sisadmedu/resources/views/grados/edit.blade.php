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
    <div class="col-md-4">
        <input type="text" name="nombre_grado" class="form-control @error('nombre_grado') is-invalid @enderror" id="nombre_grado" placeholder="Ej: 12345678" required value="{{ old('nombre_grado', $grado->nombre_grado) }}">
        @error('nombre_grado')
            <div class="text-danger mt-1 px-2 py-1" style="background-color: #ffe6e6; border-radius: 4px;">{{ $message }}</div>
        @enderror
    </div>

    <div class="d-flex justify-content-end">
        <x-boton-principal href="{{ route('grados.index') }}">
            <i class="fas fa-arrow-left"></i> Cancelar
        </x-boton-principal>
        <x-boton-principal type="submit">
            <i class="fas fa-user-plus"></i> Guardar
        </x-boton-principal>
    </div>

</div>
@endsection