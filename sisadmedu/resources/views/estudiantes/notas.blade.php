@extends('layouts.gestion')

@section('tabla')
<div class="card border-0 shadow-lg rounded-2">
    <div class="card-header text-white" style="background-color: #461c68;">
        <i class="fa-solid fa-book"></i> Notas
    </div>

    <div class="card-body">

        {{-- Filtros --}}
        <form method="GET" class="d-flex gap-3 mb-4">
            <select name="asignacion_id" class="form-select" onchange="this.form.submit()">
                <option value="">-- Todas las materias --</option>
                @foreach($materias as $asignacion)
                <option value="{{ $asignacion->id }}" @selected($asignacion->id == $asignacion_id)>
                    {{ $asignacion->materia->descripcion }}
                </option>
                @endforeach
            </select>

            <select name="periodo_id" class="form-select" onchange="this.form.submit()">
                <option value="">-- Todos los periodos --</option>
                @foreach($periodos as $periodo)
                <option value="{{ $periodo->id }}" @selected($periodo->id == $periodo_id)>
                    {{ $periodo->nombre_periodo }} | {{ $periodo->numero_periodo }}
                </option>
                @endforeach
            </select>
        </form>

        {{-- Notas filtradas --}}
        @foreach($materias as $asignacion)
        @if(!$asignacion_id || $asignacion->id == $asignacion_id)
        <h5 class="mt-3">{{ $asignacion->materia->descripcion }}</h5>
        <hr>
        <div class="row g-2">
            @foreach($periodos as $periodo)
            @if(!$periodo_id || $periodo->id == $periodo_id)
            @php
            $nota = $notasExistentes[$asignacion->id][$periodo->id] ?? null;
            @endphp
            <div class="col-md-3">
                <div class="card p-3 shadow-sm border-2 rounded-3 mb-3">
                    <h5 class="card-title">{{ $periodo->nombre_periodo }} | {{ $periodo->numero_periodo }}</h5>
                    <hr>

                    @if($nota)
                    @php
                    $aprobado = $nota['promedio'] >= 3.0;
                    @endphp

                    <p class="mb-2">
                        Promedio: <strong>{{ $nota['promedio'] }}</strong> -
                        <strong class="{{ $aprobado ? 'text-success' : 'text-danger' }}">
                            {{ $aprobado ? 'Aprobó' : 'Reprobó' }}
                        </strong>
                    </p>

                    <ul class="list-unstyled mb-0">
                        @foreach($nota['detalles'] as $detalle)
                        <li>
                            {{ $detalle['nombre_detalle'] }}: {{ $detalle['valor'] }}
                        </li>
                        @endforeach
                    </ul>
                    @else
                    <p class="text-secondary mb-0">No hay notas asignadas.</p>
                    @endif
                </div>

            </div>
            @endif
            @endforeach
        </div>
        @endif
        @endforeach

        @php
        // Filtrar solo las materias y periodos visibles según los select
        $materiasVisibles = $asignacion_id ? [$asignacion_id => $materias->firstWhere('id', $asignacion_id)] : $materias;
        $periodosVisibles = $periodo_id ? [$periodo_id => $periodos->firstWhere('id', $periodo_id)] : $periodos;

        $completo = collect($materias)->every(function($asignacion) use ($notasExistentes, $periodo_id) {
        return isset($notasExistentes[$asignacion->id][$periodo_id])
        && $notasExistentes[$asignacion->id][$periodo_id] !== null;
        });

        @endphp

        <hr>
        @if($completo)
        @php
        $user = Auth::user();

        if ($user->estudiante) {
        $estudiante_id = $user->estudiante->id;
        } else {
        // Para acudiente, $estudiante_id debe venir del contexto (por ejemplo, desde la lista de hijos)
        $estudiante_id = $estudiante->id ?? null;
        }
        @endphp

        <div class="text-center">
            <x-boton-accion
                href="{{ route('estudiante.boletin.pdf') }}?periodo_id={{ $periodo_id }}&estudiante_id={{ $estudiante_id }}">
                <i class="fa-solid fa-file-pdf"></i>
            </x-boton-accion>


        </div>
        @endif


    </div>
</div>
@endsection