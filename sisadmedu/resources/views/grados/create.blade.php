@extends('layouts.form')
@section('titulo-formulario')
Crear Nuevo Grado <i class="fas fa-plus"></i>
@endsection
@section('id-form', 'formulario-grado')
@section('ruta-accion', route('grados.store'))
@section('metodo')
@method('POST')
@section('campos-formulario')
<div class="row justify-content-center ali mb-3">
            <div class="col-md-6">
            <div class="form-floating">
                <input type="text" name="nombre_grado" class="form-control" id="nombre_grado" placeholder="Ej: 12345678" required value="{{ old('nombre_grado') }}">
                <label for="nombre_grado">Grado</label>
            </div>
        </div>

        @section('botones-formulario')
        <x-boton-principal href="{{ route('grados.index') }}">
            <i class="fas fa-arrow-left"></i> Cancelar
        </x-boton-principal>
        <x-boton-principal type="submit">
            <i class="fas fa-user-plus"></i> Guardar
        </x-boton-principal>
        @endsection
    </div>


@endsection