@extends('layouts.form')

@section('titulo-formulario')
    <i class="fa-solid fa-list-check me-2"></i>
    {{ $modo == 'editar' ? 'Editar actividad' : 'Nueva actividad' }}
@endsection

@section('id-form', 'formulario-actividad')

@section('ruta-accion', 
    $modo == 'editar'
        ? route('actividades.actualizar', $actividad->id)
        : route('actividades.guardar')
)

@section('metodo')
    @if($modo == 'editar')
        @method('PUT')
    @else
        @method('POST')
    @endif
@endsection

@section('campos-formulario')
<div class="row justify-content-center mb-3">
    <div class="col-md-8 mb-3">

        {{-- Hidden IDs --}}
        <input type="hidden" name="asignacion_id" value="{{ $asignacion_id }}">
        <input type="hidden" name="periodo_id" value="{{ $periodo_id }}">

        <div class="form-floating mb-3">
            <input
                type="text"
                name="descripcion"
                id="descripcion"
                class="form-control @error('descripcion') is-invalid @enderror"
                placeholder="Nombre de la actividad"
                value="{{ old('descripcion', $actividad->descripcion ?? '') }}"
                required>
            <label for="descripcion">Nombre de la actividad</label>

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
    <x-boton-principal href="{{ url()->previous() }}">
        <i class="fas fa-arrow-left"></i> Cancelar
    </x-boton-principal>

    <x-boton-principal type="submit">
        <i class="fas fa-save"></i>
        {{ $modo == 'editar' ? 'Actualizar' : 'Guardar' }}
    </x-boton-principal>
@endsection
