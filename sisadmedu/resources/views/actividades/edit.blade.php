@extends('layouts.app')

@section('contenido')
<div class="contenedor py-4">

    {{-- TÍTULO --}}
    <h2 class="mb-4 text-light text-center">
        <i class="fa-solid fa-pen-to-square me-2"></i>
        Editar actividad
    </h2>
    <hr>

    {{-- FORMULARIO --}}
    <form id="formulario-actividad" action="{{ route('actividades.actualizar', $actividad->id) }}" method="POST" novalidate>
        @csrf
        @method('PUT') {{-- Para enviar método PUT al actualizar --}}

        {{-- Hidden inputs --}}
        <input type="hidden" name="asignacion_id" value="{{ $actividad->asignacion_id }}">
        <input type="hidden" name="periodo_id" value="{{ $actividad->periodo_id }}">
        {{-- <input type="hidden" name="grado_id" value="{{ $grado_id }}">
        <input type="hidden" name="materia_id" value="{{ $materia_id }}"> --}}

        {{-- Campo de descripción --}}
        <div class="row justify-content-center mb-3">
            <div class="col-md-8">
                <div class="form-floating mb-3">
                    <input type="text"
                           name="descripcion"
                           id="descripcion"
                           class="form-control @error('descripcion') is-invalid @enderror"
                           placeholder="Nombre de la actividad"
                           value="{{ old('descripcion', $actividad->descripcion) }}"
                           required>
                    <label for="descripcion">Nombre de la actividad</label>

                    {{-- Error de validación --}}
                    @error('descripcion')
                        <div class="text-danger mt-1 px-2 py-1" style="background-color: #ffe6e6; border-radius: 4px;">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
        </div>

        {{-- BOTÓN ACTUALIZAR --}}
        <div class="d-flex justify-content-end gap-2">
            <x-boton-principal type="submit">
                <i class="fas fa-save"></i> Actualizar
            </x-boton-principal>
        </div>
    </form>
</div>
@endsection
