@extends('layouts.gestion')

@section('titulo')
@endsection

@section('boton-registrar')
    {{-- 🔹 Filtro por grado --}}
    <form method="GET" action="{{ route('docente.asignaturas') }}" class="d-flex align-items-center gap-3 mb-4">
        <label for="grado_id" class="fw-semibold mb-0">
            <i class="fa-solid fa-layer-group me-2"></i> Selecciona un grado:
        </label>

        <select name="grado_id" id="grado_id" class="form-select shadow-sm border-0 rounded-3"
                style="width: 250px;" onchange="this.form.submit()">
            <option value="">-- Selecciona un grado --</option>
            @foreach ($grados as $grado)
                <option value="{{ $grado->id }}" {{ $gradoSeleccionado == $grado->id ? 'selected' : '' }}>
                    {{ $grado->nombre_grado }}
                </option>
            @endforeach
        </select>
    </form>
@endsection

@section('tabla')
    {{-- 🔹 Si no se ha seleccionado un grado --}}
    @if (empty($gradoSeleccionado))
        <div class="alert alert-secondary shadow-sm mt-3 d-flex align-items-center justify-content-center">
            <i class="fa-solid fa-circle-info me-2"></i>
            Selecciona un grado para ver las materias y los estudiantes asignados.
        </div>

    {{-- 🔹 Si se seleccionó un grado --}}
    @else
        @forelse ($materiasAsignadas as $asignacion)
            <div class="card shadow-sm border-0 rounded-4 overflow-hidden mb-4">
                <div class="card-header text-white fw-bold d-flex align-items-center"
                     style="background-color: #461c68;">
                    <i class="fa-solid fa-book me-2"></i>
                    {{ $asignacion['materia'] }} |
                    <span class="ms-1">Grado {{ $asignacion['grado'] }}</span>
                </div>

                <div class="card-body bg-light">
                    @if ($asignacion['estudiantes']->isEmpty())
                        <div class="alert alert-secondary text-center mb-0 d-flex align-items-center justify-content-center">
                            <i class="fa-solid fa-user-slash me-2"></i>
                            No hay estudiantes registrados en este grado.
                        </div>
                    @else
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0 text-center">
                                <thead>
                                    <tr>
                                        <th> Documento</th>
                                        <th> Matrícula</th>
                                        <th> Nombre completo</th>
                                        <th> Grado</th>
                                        <th> Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($asignacion['estudiantes'] as $estudiante)
                                        <tr>
                                            <td>{{ $estudiante['documento'] ?? '—' }}</td>
                                            <td>{{ $estudiante['matricula'] ?? '—' }}</td>
                                            <td>{{ $estudiante['nombre'] }}</td>
                                            <td><span class="badge rounded-pill px-3 py-2" style="background-color: #461c68; color: #fff;">{{ $estudiante['grado'] }}</span></td>
                                            <td>
                                                <x-boton-accion tipo="editar" href="#" texto="Asignar Nota" />
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        @empty
            <div class="alert alert-warning shadow-sm mt-3 d-flex align-items-center justify-content-center">
                <i class="fa-solid fa-circle-info me-2"></i>
                No tienes materias asignadas para este grado.
            </div>
        @endforelse
    @endif
@endsection
