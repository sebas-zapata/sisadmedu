@extends('layouts.gestion')

@section('titulo')
@endsection

@section('boton-registrar')
<form method="GET" action="{{ route('docente.estudiantes') }}" class="d-flex align-items-center gap-3 mb-4">
    <label for="grado_id" class="fw-semibold mb-0">
        <i class="fa-solid fa-layer-group me-2"></i> Selecciona un grado:
    </label>

    <select name="grado_id" id="grado_id" class="form-select shadow-sm border-0 rounded-3" style="width: 250px;" onchange="this.form.submit()">
        <option value="">-- Selecciona --</option>
        @foreach ($grados as $grado)
        <option value="{{ $grado->id }}" {{ $gradoSeleccionado == $grado->id ? 'selected' : '' }}>
            {{ $grado->nombre_grado }}
        </option>
        @endforeach
    </select>
</form>
@endsection

@section('tabla')
@if ($gradoSeleccionado)
<div class="card shadow-sm border-0 rounded-4 overflow-hidden">
    <div class="card-header text-white fw-bold d-flex align-items-center text-center" style="background-color: #461c68;">
        <i class="fa-solid fa-users me-2"></i> Estudiantes Matriculados
    </div>

    <div class="card-body bg-light">
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
                    @forelse ($estudiantes as $estudiante)
                    <tr>
                        <td>{{ $estudiante->usuario->documento }}</td>
                        <td>{{ $estudiante->matricula }}</td>
                        <td>
                            {{ $estudiante->primer_nombre_estudiante }}
                            {{ $estudiante->segundo_nombre_estudiante }}
                            {{ $estudiante->primer_apellido_estudiante }}
                            {{ $estudiante->segundo_apellido_estudiante }}
                        </td>
                        <td>
                            <span class="badge rounded-pill px-3 py-2" style="background-color: #461c68; color: #fff;">
                                {{ $estudiante->grado->nombre_grado }}
                            </span>
                        </td>
                        <td>
                            <x-boton-accion tipo="ver" href="{{ route('docente.estudiante', $estudiante->id) }}" />
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-muted py-3">No hay estudiantes registrados en este grado.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@else
<div class="alert alert-secondary shadow-sm mt-3 d-flex align-items-center justify-content-center">
    <i class="fa-solid fa-circle-info me-2"></i>
    Selecciona un grado para ver los estudiantes matriculados.
</div>
@endif
@endsection
