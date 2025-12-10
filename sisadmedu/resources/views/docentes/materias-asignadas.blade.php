@extends('layouts.gestion')

@section('filtros')

<form id="filtroForm" method="GET" action="{{ route('docente.asignaturas') }}"
    class="d-flex align-items-center gap-3 mb-4">

    {{-- SELECT DE GRADOS --}}
    <select name="grado_id" id="grado_id" class="form-select shadow-sm border-0 rounded-3"
        style="width: 250px;" onchange="enviarFiltro()">
        <option value="">-- Selecciona un grado --</option>
        @foreach ($grados as $grado)
            <option value="{{ $grado->id }}" {{ $gradoSeleccionado == $grado->id ? 'selected' : '' }}>
                {{ $grado->nombre_grado }}
            </option>
        @endforeach
    </select>

    {{-- SELECT DE MATERIAS --}}
    @if(!empty($gradoSeleccionado))
        <select name="materia_id" id="materia_id" class="form-select shadow-sm border-0 rounded-3"
            style="width: 250px;" onchange="enviarFiltro()">
            <option value="">-- Selecciona una materia --</option>
            @foreach ($materias as $m)
                <option value="{{ $m->id }}" {{ $materiaSeleccionada == $m->id ? 'selected' : '' }}>
                    {{ $m->materia->descripcion }}
                </option>
            @endforeach
        </select>
    @endif

</form>

<script>
function enviarFiltro() {
    document.getElementById("filtroForm").submit();
}
</script>

@endsection



@section('tabla')

{{-- SI NO SE HA SELECCIONADO NADA --}}
@if (empty($gradoSeleccionado))
    <div class="alert alert-secondary shadow-sm mt-3 text-center">
        Selecciona un grado para ver las materias.
    </div>

{{-- SI HAY GRADO PERO NO MATERIA --}}
@elseif(!empty($gradoSeleccionado) && empty($materiaSeleccionada))
    <div class="alert alert-secondary shadow-sm mt-3 text-center">
        Ahora selecciona una materia.
    </div>

{{-- SI HAY GRADO + MATERIA PERO NO EXISTE ASIGNACIÓN --}}
@elseif(empty($asignacionSeleccionada))
    <div class="alert alert-danger shadow-sm mt-3 text-center">
        La materia seleccionada no pertenece al grado seleccionado.
    </div>

{{-- SI TODO ES CORRECTO --}}
@else
    <div class="shadow-sm border-0 overflow-hidden mb-4">
        
        {{-- TITULO --}}
        @section('titulo')
            <i class="fa-solid fa-book me-2"></i>
            {{ $asignacionSeleccionada['materia'] }} | Grado {{ $asignacionSeleccionada['grado'] }}
        @endsection

        {{-- BOTÓN DE TOMAR ASISTENCIA --}}
        @section('acciones')
            <x-boton-principal href="{{ route('asistencias.porAsignacion', $asignacionSeleccionada['id']) }}">
                <i class="fa-solid fa-clipboard-check me-1"></i> Tomar asistencia
            </x-boton-principal>
        @endsection

        {{-- TABLA --}}
        <div class="table bg-light">
            @if ($asignacionSeleccionada['estudiantes']->isEmpty())
                <div class="alert alert-secondary text-center mb-0">
                    No hay estudiantes registrados en este grado.
                </div>
            @else
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0 text-center">
                    <thead>
                        <tr>
                            <th>Documento</th>
                            <th>Matrícula</th>
                            <th>Nombre completo</th>
                            <th>Grado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($asignacionSeleccionada['estudiantes'] as $estudiante)
                            <tr>
                                <td>{{ $estudiante['documento'] ?? '—' }}</td>
                                <td>{{ $estudiante['matricula'] ?? '—' }}</td>
                                <td>{{ $estudiante['nombre'] }}</td>
                                <td>
                                    <span class="badge rounded-pill px-3 py-2" style="background-color: #461c68; color: #fff;">
                                        {{ $estudiante['grado'] }}
                                    </span>
                                </td>
                                <td>
                                    <x-boton-accion tipo="editar"
                                        href="{{ route('notas.create', ['estudiante_id' => $estudiante['id'], 'asignacion_id' => $asignacionSeleccionada['id']]) }}"
                                        texto="Asignar Nota" />
                                </td>
                            </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>
            @endif
        </div>
    </div>

@endif

@endsection
