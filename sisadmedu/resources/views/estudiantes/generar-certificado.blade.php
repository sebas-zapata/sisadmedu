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
            <input type="text"
                maxlength="15"
                name="matricula"
                id="codigo"
                class="form-control @error('matricula') is-invalid @enderror"
                placeholder="Ingresa tu numero de matricula"
                value="{{ old('matricula') }}"
                required>
            <label for="descripcion">Codigo de matricula</label>
            @error('matricula')
            <div class="text-danger mt-1 px-2 py-1 text-center" style="background-color: #ffe6e6; border-radius: 4px;">
                {{ $message }}
            </div>
            @enderror
        </div>
    </div>
</div>
@endsection

@section('botones-formulario')
<x-boton-principal href="{{ route('dashboard') }}">
    <i class="fas fa-arrow-left"></i> Cancelar
</x-boton-principal>

<x-boton-principal id="generar-certificado" type="submit">
    <i class="fas fa-save"></i> Generar
</x-boton-principal>
@endsection