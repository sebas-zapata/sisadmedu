@extends('layouts.gestion')

@section('titulo')
<i class="fa-solid fa-clipboard-check me-2"></i>
Asistencia - {{ $asignacion->materia->descripcion }}
@endsection

@section('tabla')
<div class="card shadow-sm border-0 rounded-1 p-2">
    <div class="">

        {{-- 🔍 Selector de fecha --}}
        <form method="GET" action="{{ route('asistencias.porAsignacion', $asignacion->id) }}" class="mb-3">
            @section('filtros')
            <input
                type="date"
                name="fecha"
                value="{{ $fecha }}"
                class="form-control d-inline-block w-auto"
                onchange="this.form.submit()">
            @endsection

            @section('acciones')
            <x-boton-principal href="{{ route('asistencias.reporteMensual', $asignacion->id) }}">
                <i class="fa-solid fa-chart-column me-1"></i> Reporte Mensual
            </x-boton-principal>
            @endsection
        </form>

        {{-- 📝 Formulario de asistencia --}}
        <form action="{{ route('asistencias.store') }}" method="POST">
            @csrf
            <input type="hidden" name="asignacion_id" value="{{ $asignacion->id }}">
            {{-- 🔑 Este campo se actualiza con la fecha que se está mostrando --}}
            <input type="hidden" name="fecha" value="{{ $fecha }}">

            <div class="table-responsive">
                <table class="table table-bordered align-middle text-center">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Estudiante</th>
                            <th>Estado</th>
                            <th>Justificada</th>
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
                                        <option value="si" {{ $asistencia?->justificada ? 'selected' : '' }}>Sí</option>
                                        <option value="no" {{ !$asistencia?->justificada && $asistencia?->estado ? 'selected' : '' }}>No</option>
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

            <div class="d-flex justify-content-end mt-3">
                <x-boton-principal type="submit">
                    <i class="fa-solid fa-save me-2"></i> Guardar asistencia
                </x-boton-principal>
            </div>
        </form>
    </div>
</div>

{{-- 🎯 Script para mostrar/ocultar justificación --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.estado-select').forEach(select => {
            const row = select.closest('tr');
            const justificacion = row.querySelector('.justificacion-select');
            const estado = select.value;
            justificacion.style.display = (estado === 'ausente' || estado === 'excusa') ? 'block' : 'none';

            select.addEventListener('change', function() {
                const estadoNuevo = this.value;
                justificacion.style.display = (estadoNuevo === 'ausente' || estadoNuevo === 'excusa') ? 'block' : 'none';
                if (estadoNuevo !== 'ausente' && estadoNuevo !== 'excusa') {
                    justificacion.value = '';
                }
            });
        });
    });
</script>
@endsection
