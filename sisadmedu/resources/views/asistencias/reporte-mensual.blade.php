@extends('layouts.gestion')

@section('titulo')
    <i class="fa-solid fa-calendar-days me-2"></i> Reporte Mensual de Asistencias - {{ $asignacion->materia->descripcion }}
@endsection

@section('tabla')
    <div class="card shadow-sm border-0 rounded-4 overflow-hidden">
        <div class="card-body bg-light">
            {{-- 🔹 Formulario para seleccionar mes y año --}}
            <form method="GET" action="{{ route('asistencias.reporteMensual', $asignacion->id) }}" class="row g-3 mb-4">
                <div class="col-md-4">
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
                <div class="col-md-4">
                    <label for="anio" class="form-label fw-semibold">Año</label>
                    <select name="anio" id="anio" class="form-select">
                        <option value="">-- Seleccione --</option>
                        @foreach (range(date('Y') - 3, date('Y')) as $y)
                            <option value="{{ $y }}" {{ $y == $anio ? 'selected' : '' }}>{{ $y }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="fa-solid fa-magnifying-glass me-1"></i> Ver reporte
                    </button>
                </div>
            </form>

            {{-- 🔹 Mostrar tabla solo si hay mes y año seleccionados --}}
            @if ($mes && $anio)
                <div class="table-responsive">
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
                        <a href="{{ route('asistencias.reporteMensual.pdf', [
                            'asignacion' => $asignacion->id,
                            'mes' => $mes,
                            'anio' => $anio,
                        ]) }}"
                            class="btn btn-danger">
                            <i class="fa-solid fa-file-pdf me-1"></i> Descargar PDF
                        </a>
                    </div>
                @endif
            @endif
        </div>
    </div>
@endsection
