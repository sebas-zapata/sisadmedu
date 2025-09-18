@extends('layouts.form')

@section('titulo-formulario')
Nuevo Grado <i class="fas fa-layer-group"></i>
@endsection

@section('id-form', 'formulario-grado')

@section('ruta-accion', route('grados.store'))

@section('metodo')
    @method('POST')
@endsection

@section('campos-formulario')
    <div class="row justify-content-center mb-3">
        <div class="col-md-6 mb-3">
            <select name="nivel_grado" id="nivel_grado"
                class="form-control @error('nivel_grado') is-invalid @enderror" required>
                <option value="">-- Seleccione un nivel --</option>
                    @for ($i = 1; $i <= 11; $i++)
                        <option value="{{ $i }}" {{ old('nivel_grado') == $i ? 'selected' : '' }}>
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
            <select name="grupo_grado" id="grupo_grado"
                class="form-control @error('grupo_grado') is-invalid @enderror" required>
                <option value="">-- Seleccione un grupo --</option>
                <option value="1" {{ old('grupo_grado') == 1 ? 'selected' : '' }}>1</option>
                <option value="2" {{ old('grupo_grado') == 2 ? 'selected' : '' }}>2</option>
                <option value="3" {{ old('grupo_grado') == 3 ? 'selected' : '' }}>3</option>
                <option value="4" {{ old('grupo_grado') == 4 ? 'selected' : '' }}>4</option>
                <option value="5" {{ old('grupo_grado') == 5 ? 'selected' : '' }}>5</option>
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
       <i class="fas fa-save"></i> Guardar
    </x-boton-principal>
@endsection
