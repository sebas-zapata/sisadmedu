@extends('layouts.gestion')

@section('tabla')
<div class="card border-0 shadow-lg rounded-2">
    <div class="card-header text-white d-flex align-items-center gap-2" style="background-color: #461c68;">
        <i class="bi bi-journal-check fs-4"></i>
        <span class="fw-semibold">
            Registrar / Editar Notas: 
            {{ $estudiante->primer_nombre_estudiante }} {{ $estudiante->segundo_nombre_estudiante }} 
            {{ $estudiante->primer_apellido_estudiante }} {{ $estudiante->segundo_apellido_estudiante }}
            | {{ $asignacion->materia->descripcion }}
        </span>
    </div>

    <div class="card-body p-4">

        {{-- JSON seguro para JS --}}
        <script id="notas-data" type="application/json">
            {!! json_encode($notasExistentes, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) !!}
        </script>

        <div id="resultadoPromedio" class="fw-bold fs-5"></div>

        <form action="{{ route('notas.store') }}" method="POST" id="formNotas" class="mt-4">
            @csrf

            <input type="hidden" name="estudiante_id" value="{{ $estudiante->id }}">
            <input type="hidden" name="asignacion_id" value="{{ $asignacion->id }}">

            <div>
                <label for="selectPeriodo" class="form-label fw-semibold">
                </label>
                <select name="periodo_id" id="selectPeriodo" class="form-select" required>
                    <option value="">-- Selecciona un periodo --</option>
                    @foreach($periodos as $periodo)
                        <option value="{{ $periodo->id }}">{{ $periodo->nombre_periodo }} | {{ $periodo->numero_periodo}}</option>
                    @endforeach
                </select>
            </div>

            <div id="contenedorBoton" class="text-center mt-4">
                <x-boton-principal type="submit">
                    <i class="bi bi-save me-1"></i> Guardar Notas
                </x-boton-principal>
            </div>
            {{-- TARJETAS DE NOTAS --}}
            <div id="detalles" class="row g-3 mt-3"></div>

        </form>
    </div>
</div>
@endsection
