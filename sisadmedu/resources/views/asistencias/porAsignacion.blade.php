@extends('layouts.gestion')

@section('titulo')
    <i class="fa-solid fa-clipboard-check me-2"></i>
    Tomar asistencia - {{ $asignacion->materia->descripcion }}
    (Grado {{ $asignacion->grado->nombre_grado }})
@endsection

@section('tabla')
<div class="card shadow-sm border-0 rounded-4 overflow-hidden">
    <div class="card-body bg-light">

        {{-- 🔹 Selector de fecha --}}
        <form method="GET" action="{{ route('asistencias.porAsignacion', $asignacion->id) }}" class="mb-3">
            <div class="d-flex align-items-center justify-content-between flex-wrap gap-2">
                <div>
                    <label class="fw-semibold me-2">Selecciona una fecha:</label>
                    <input type="date" name="fecha" value="{{ $fecha }}" class="form-control d-inline-block w-auto"
                           onchange="this.form.submit()">
                </div>

                <div class="d-flex gap-2">
                    {{-- 🔸 Botón para ir al reporte mensual --}}
                    <a href="{{ route('asistencias.reporteMensual', $asignacion->id) }}"
                       class="btn-asistencia">
                        <i class="fa-solid fa-chart-column me-1"></i> Reporte Mensual
                    </a>

                    {{-- 🔸 Botón para volver --}}
                    <a href="{{ route('docente.asignaturas', ['grado_id' => $asignacion->grado->id]) }}"
                       class="btn btn-secondary">
                        <i class="fa-solid fa-arrow-left me-1"></i> Volver
                    </a>
                </div>
            </div>
        </form>

        {{-- 🔹 Formulario de asistencia --}}
        <form action="{{ route('asistencias.store') }}" method="POST">
            @csrf
            <input type="hidden" name="asignacion_id" value="{{ $asignacion->id }}">
            <input type="hidden" name="fecha" value="{{ $fecha }}">

            <div class="table-responsive">
                <table class="table table-hover align-middle text-center">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Nombre del estudiante</th>
                            <th>Estado</th>
                            <th>Justificación</th>
                            <th>Observación</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($estudiantes as $index => $estudiante)
                            @php
                                $asistencia = $asistenciasExistentes->get($estudiante->id);
                            @endphp
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>
                                    {{ $estudiante->primer_nombre_estudiante }} {{ $estudiante->primer_apellido_estudiante }}
                                    <input type="hidden" name="asistencias[{{ $index }}][estudiante_id]" value="{{ $estudiante->id }}">
                                </td>
                                <td>
                                    <select name="asistencias[{{ $index }}][estado]" class="form-select estado-select" required>
                                        <option value="presente" {{ $asistencia?->estado == 'presente' ? 'selected' : '' }}>Presente</option>
                                        <option value="ausente" {{ $asistencia?->estado == 'ausente' ? 'selected' : '' }}>Ausente</option>
                                        <option value="tarde" {{ $asistencia?->estado == 'tarde' ? 'selected' : '' }}>Tarde</option>
                                        <option value="excusa" {{ $asistencia?->estado == 'excusa' ? 'selected' : '' }}>Excusa</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="asistencias[{{ $index }}][justificacion]" class="form-select justificacion-select"
                                            style="{{ in_array($asistencia?->estado, ['ausente', 'excusa']) ? '' : 'display:none;' }}">
                                        <option value="">Seleccione...</option>
                                        <option value="si" {{ $asistencia?->justificacion == 'si' ? 'selected' : '' }}>Sí</option>
                                        <option value="no" {{ $asistencia?->justificacion == 'no' ? 'selected' : '' }}>No</option>
                                    </select>
                                </td>
                                <td>
                                    <input type="text" name="asistencias[{{ $index }}][observacion]"
                                           class="form-control" value="{{ $asistencia?->observacion }}" placeholder="Opcional">
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-end mt-4">
                <button type="submit" class="btn btn-primary px-4">
                    <i class="fa-solid fa-save me-2"></i> Guardar cambios
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.estado-select').forEach(select => {
            select.addEventListener('change', function() {
                const row = this.closest('tr');
                const justificacion = row.querySelector('.justificacion-select');
                if (this.value === 'ausente' || this.value === 'excusa') {
                    justificacion.style.display = 'block';
                } else {
                    justificacion.style.display = 'none';
                    justificacion.value = '';
                }
            });
        });
    });
</script>
@endsection
