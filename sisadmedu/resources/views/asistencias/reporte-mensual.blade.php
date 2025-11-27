@extends('layouts.gestion')

@section('titulo')
<i class="fa-solid fa-calendar-days me-2"></i> Reporte Mensual de Asistencias - {{ $asignacion->materia->descripcion }}
@endsection

@section('tabla')
<div class="shadow-sm border-0 overflow-hidden">
    <div class="bg-light p-2 rounded-1">
        <form method="GET" action="{{ route('asistencias.reporteMensual', $asignacion->id) }}" class="row g-3 mb-4">

            {{-- Botones (izquierda en desktop, centrados en móvil) --}}
            <div class="col-md-2 d-flex flex-wrap justify-content-center justify-content-md-center align-items-end gap-2">

                <x-boton-accion type="submit">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </x-boton-accion>

                <x-boton-accion href="{{ route('asistencias.reporteMensual.pdf', [
                'asignacion' => $asignacion->id,
                'mes' => $mes,
                'anio' => $anio,
            ]) }}">
                    <i class="fa-solid fa-file-pdf me-1"></i>
                </x-boton-accion>

            </div>

            {{-- Select Mes --}}
            <div class="col-md-5 d-flex flex-column">
                <label for="mes" class="form-label fw-semibold">Mes</label>
                <select name="mes" id="mes" class="form-select">
                    <option value="">-- Seleccione --</option>
                    @foreach (range(1, 12) as $m)
                    <option value="{{ $m }}" {{ $m == $mes ? 'selected' : '' }}>
                        {{ ucfirst(\Carbon\Carbon::create()->month($m)->locale('es')->monthName) }}
                    </option>
                    @endforeach
                </select>
            </div>

            {{-- Select Año --}}
            <div class="col-md-5 d-flex flex-column">
                <label for="anio" class="form-label fw-semibold">Año</label>
                <select name="anio" id="anio" class="form-select">
                    <option value="">-- Seleccione --</option>
                    @foreach (range(date('Y') - 3, date('Y')) as $y)
                    <option value="{{ $y }}" {{ $y == $anio ? 'selected' : '' }}>{{ $y }}</option>
                    @endforeach
                </select>
            </div>

        </form>


        {{-- 🔹 Mostrar tabla solo si hay mes y año seleccionados --}}
        @if ($mes && $anio)
        <div class="table-responsive p-2">
            <table class="table table-bordered align-middle text-center">
                <thead class="table-dark">
                    <tr>
                        <th>Estudiante</th>
                        @foreach ($diasDelMes as $dia)
                        <th>{{ $dia }}</th>
                        @endforeach
                        <th class="bg-secondary text-white">P</th>
                        <th class="bg-secondary text-white">A</th>
                        <th class="bg-secondary text-white">T</th>
                        <th class="bg-secondary text-white">E</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($asignacion->grado->estudiantes as $estudiante)
                    @php
                    $presentes = $ausentes = $tardes = $excusas = 0;
                    @endphp
                    <tr>
                        <td class="text-start fw-semibold">
                            {{ $estudiante->primer_nombre_estudiante }}
                            {{ $estudiante->primer_apellido_estudiante }}
                        </td>

                        @foreach ($diasDelMes as $dia)
                        @php
                        $fecha = \Carbon\Carbon::createFromDate($anio, $mes, $dia)->format('Y-m-d');
                        $registro = isset($asistencias[$estudiante->id])
                        ? $asistencias[$estudiante->id]->firstWhere('fecha', $fecha)
                        : null;
                        @endphp

                        <td>
                            @if ($registro)
                            @switch($registro->estado)
                            @case('presente')
                            <span class="badge bg-success">P</span>
                            @php $presentes++; @endphp
                            @break

                            @case('ausente')
                            <span class="badge bg-danger">A</span>
                            @php $ausentes++; @endphp
                            @break

                            @case('tarde')
                            <span class="badge bg-warning text-dark">T</span>
                            @php $tardes++; @endphp
                            @break

                            @case('excusa')
                            <span class="badge bg-info text-dark">E</span>
                            @php $excusas++; @endphp
                            @break
                            @endswitch
                            @else
                            <span class="text-muted">—</span>
                            @endif
                        </td>
                        @endforeach

                        <td class="fw-bold">{{ $presentes }}</td>
                        <td class="fw-bold">{{ $ausentes }}</td>
                        <td class="fw-bold">{{ $tardes }}</td>
                        <td class="fw-bold">{{ $excusas }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        @if ($mes && $anio)
        <div class="text-end mt-3">

        </div>
        @endif
        @endif
    </div>
</div>
@endsection