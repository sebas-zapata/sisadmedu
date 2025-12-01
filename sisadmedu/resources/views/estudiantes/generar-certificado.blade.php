@extends('layouts.form')

@section('titulo-formulario')
<i class="fas fa-book"></i> Generar Certificado
@endsection

@section('id-form', 'formulario-certificado')

@section('ruta-accion', route('pdf.certificado'))

@section('metodo')
@method('POST')
@endsection

@section('campos-formulario')
<div class="row justify-content-center mb-3">
    <div class="col-md-8 mb-3">
        <div class="form-floating mb-3">
            <input type="number"
                name="documento"
                id="documento"
                class="form-control @error('documento') is-invalid @enderror"
                placeholder="Ingresa tu numero de documento"
                value="{{ old('documento') }}"
                required>
            <label for="descripcion">Numero de documento</label>
            @error('documento')
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
    <i class="fas fa-save"></i> Generar
</x-boton-principal>
@endsection