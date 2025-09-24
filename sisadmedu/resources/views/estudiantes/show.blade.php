@extends('layouts.show')
<meta name="has-errors" content="{{ $errors->any() ? 'true' : 'false' }}">

@section('informacion')
<div class="text-center">
    <img src="{{ Avatar::create($estudiante->primer_nombre_estudiante . ' ' . $estudiante->segundo_nombre_estudiante . ' ' . $estudiante->primer_apellido_estudiante . ' ' . $estudiante->segundo_apellido_estudiante)->toBase64() }}"
        alt="Avatar"
        class="rounded-circle shadow mb-3"
        width="100"
        height="100">
    <h4 class="fw-bold mb-0">
        {{ $estudiante->primer_nombre_estudiante }}
        {{ $estudiante->segundo_nombre_estudiante }}
        {{ $estudiante->primer_apellido_estudiante }}
        {{ $estudiante->segundo_apellido_estudiante }}
    </h4>
    <hr class="my-4">
</div>

<div class="row mb-3">
    <div class="col-md-6 mb-3 text-center">
        <i class="fa-solid fa-key text-light"></i>
        <strong>Identificador:</strong>
        <p class="mb-0">{{ $estudiante->id }}</p>
    </div>

    <div class="col-md-6 mb-3 text-center">
        <i class="fas fa-file-signature text-light"></i>
        <strong>Matricula:</strong>
        <p class="mb-0">{{ $estudiante->matricula }}</p>
    </div>

    <div class="col-md-6 mb-3 text-center">
        <i class="fas fa-id-card me-2 text-light"></i>
        <strong>Documento:</strong>
        <p class="mb-0">{{ $estudiante->documento_estudiante }}</p>
    </div>

    <div class="col-md-6 mb-3 text-center">
        <i class="fas fa-envelope me-2 text-light"></i>
        <strong>Correo Electrónico:</strong>
        <p class="mb-0">{{ $estudiante->correo_electronico_estudiante ?? 'No registrado' }}</p>
    </div>

    <div class="col-md-6 mb-3 text-center">
        <i class="fas fa-graduation-cap me-2 text-light"></i>
        <strong>Grado:</strong>
        <p class="mb-0">{{ $estudiante->grado->nombre_grado }}</p>
    </div>

    <div class="col-md-6 mb-3 text-center">
        <i class="fas fa-id-card-alt me-2 text-light"></i>
        <strong>Tipo de Documento:</strong>
        <p class="mb-0">{{ $estudiante->tipoDocumento->descripcion }}</p>
    </div>

    <div class="col-md-6 mb-3 text-center">
        <i class="fas fa-phone me-2 text-light"></i>
        <strong>Teléfono:</strong>
        <p class="mb-0">{{ $estudiante->telefono_estudiante ?? 'No registrado' }}</p>
    </div>

    <div class="col-md-6 mb-3 text-center">
        <i class="fas fa-mobile-alt me-2 text-light"></i>
        <strong>Celular:</strong>
        <p class="mb-0">{{ $estudiante->celular_estudiante ?? 'No registrado' }}</p>
    </div>

    <div class="col-md-6 mb-3 text-center">
        <i class="fas fa-map-marker-alt me-2 text-light"></i>
        <strong>Dirección:</strong>
        <p class="mb-0">{{ $estudiante->direccion_estudiante ?? 'No registrada' }}</p>
    </div>

    <div class="col-md-6 mb-3 text-center">
        <i class="fas fa-birthday-cake me-2 text-light"></i>
        <strong>Fecha de Nacimiento:</strong>
        <p class="mb-0">{{ \Carbon\Carbon::parse($estudiante->fecha_nacimiento_estudiante)->format('d/m/Y') }}</p>
    </div>

    <div class="col-md-6 mb-3 text-center">
        <i class="fas fa-user-clock me-2 text-light"></i>
        <strong>Edad:</strong>
        <p class="mb-0">{{ $estudiante->edad_estudiante }} años</p>
    </div>

    <div class="col-md-6 mb-3 text-center">
        <i class="fas fa-calendar-plus me-2 text-light"></i>
        <strong>Fecha de creación:</strong>
        <p class="mb-0">{{ $estudiante->created_at->format('d/m/Y H:i') }}</p>
    </div>

    <div class="col-md-6 mb-3 text-center">
        <i class="fas fa-calendar-alt me-2 text-light"></i>
        <strong>Última actualización:</strong>
        <p class="mb-0">{{ $estudiante->updated_at->format('d/m/Y H:i') }}</p>
    </div>

</div>
<!-- Modal Observacion -->
<div class="modal fade" id="modalObservacion" tabindex="-1" aria-labelledby="modalObservacionLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header  text-white">
                <h5 class="modal-title" id="modalObservacionLabel">Nueva Observación</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form action="{{ route('observacion.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <!-- Campo oculto estudiante -->
                    <input type="hidden" name="estudiante_id" value="{{ $estudiante->id }}">
                    <!-- Campo oculto docente (ejemplo si tienes auth) -->
                    <input type="hidden" name="docente_id" value="{{ Auth::user()->docente->id ?? '' }}">
                    <!-- Tipo de Observación -->
                    <div class="form-floating mb-3">
                        <select name="tipo" id="tipo" class="form-select @error('tipo') is-invalid @enderror">
                            <option value="" disabled {{ old('tipo') ? '' : 'selected' }}>Seleccione una opción</option>
                            <option value="academica" {{ old('tipo') == 'academica' ? 'selected' : '' }}>Académica</option>
                            <option value="comportamental" {{ old('tipo') == 'comportamental' ? 'selected' : '' }}>Comportamental</option>
                            <option value="otra" {{ old('tipo') == 'otra' ? 'selected' : '' }}>Otra</option>
                        </select>
                        <label for="tipo">Tipo de Observación</label>
                        @error('tipo')
                        <div class="text-danger mt-1 px-2 py-1" style="background-color:#ffe6e6; border-radius:4px;">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Descripción -->
                    <div class="form-floating mb-3">
                        <textarea name="descripcion" id="descripcion" class="form-control @error('descripcion') is-invalid @enderror" style="height: 120px">{{ old('descripcion') }}</textarea>
                        <label for="descripcion">Descripción</label>
                        @error('descripcion')
                        <div class="text-danger mt-1 px-2 py-1" style="background-color:#ffe6e6; border-radius:4px;">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-floating mb-3">
                        <select name="docente_id" id="docente_id"
                            class="form-select @error('docente_id') is-invalid @enderror">
                            @foreach($docentes as $docente)
                            <option value="{{ $docente->id }}" selected>
                                {{ $docente->primer_nombre }}
                                {{ $docente->segundo_nombre }}
                                {{ $docente->primer_apellido }}
                                {{ $docente->segundo_apellido }}
                            </option>
                            @endforeach
                        </select>
                        <label for="docente_id">Docente</label>
                        @error('docente_id')
                        <div class="text-danger mt-1 px-2 py-1"
                            style="background-color:#ffe6e6; border-radius:4px;">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>

                <div class="modal-footer">
                    <x-boton-principal type="button" data-bs-dismiss="modal">
                        Cancelar
                    </x-boton-principal>
                    <x-boton-principal type="submit">
                        <i class="fas fa-save me-1"></i> Guardar
                    </x-boton-principal>
                </div>
            </form>
        </div>
    </div>
</div>


<hr class="my-4">

{{-- Mostrar acudientes solo si existen --}}
@if($estudiante->acudientes && $estudiante->acudientes->isNotEmpty())
<div class="mt-4">
    <h5 class="fw-bold text-center text-light">Acudientes Asignados</h5>

    <div class="list-group">
        @foreach($estudiante->acudientes as $acudiente)
        <div class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
            <div>
                <h6 class="fw-bold mb-1">
                    {{ $acudiente->nombres }} {{ $acudiente->apellidos }}
                </h6>
                <small class="text-muted d-block">
                    <strong>ID:</strong> {{ $acudiente->id }} |
                    <strong>Documento:</strong> {{ $acudiente->documento }}
                </small>
                <small class="text-muted d-block">
                    <strong>Teléfono:</strong> {{ $acudiente->telefono ?? 'No registrado' }}
                </small>
                <small class="text-muted d-block">
                    <strong>Correo:</strong> {{ $acudiente->correo_electronico ?? 'No registrado' }}
                </small>
            </div>
            <span class="badge bg-dark rounded-pill">
                Acudiente
            </span>
        </div>
        @endforeach
    </div>

</div>
@else
<p class="text-center text-muted">Este estudiante aún no tiene acudientes asignados.</p>
@endif

<hr class="my-4">
<h5 class="fw-bold mb-4 text-center text-light"><i class="fas fa-clipboard-list"></i>
    Observaciones</h5>
<div class="card rounded-3 mt-1">
    <div class="card-body text-center">

        <!-- Botones -->
        <!-- Botón Agregar Observación -->
        <x-boton-principal type="button" data-bs-toggle="modal" data-bs-target="#modalObservacion">
            <i class="fas fa-comment-medical me-1"></i> Agregar Observación
        </x-boton-principal>

        <!-- Botón Ver Observaciones -->
        <x-boton-principal type="button" data-bs-toggle="modal" data-bs-target="#modalVerObservaciones">
            <i class="fas fa-eye me-1"></i> Ver Observaciones
        </x-boton-principal>
    </div>
</div>

<!-- Modal Ver Observaciones -->
<div class="modal fade" id="modalVerObservaciones" tabindex="-1" aria-labelledby="modalVerObservacionesLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable"><!-- scroll interno -->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold text-light" id="modalVerObservacionesLabel">Observaciones del Estudiante</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body">
                @if($estudiante->observaciones->isNotEmpty())
                <div class="list-group">
                    @foreach($estudiante->observaciones as $observacion)
                    <div class="list-group-item">
                        <strong>{{ ucfirst($observacion->tipo) }}:</strong> {{ $observacion->descripcion }}
                        <br>
                        <small class="text-muted">
                            Por: {{ $observacion->docente->primer_nombre }} {{ $observacion->docente->primer_apellido }}
                            | {{ $observacion->created_at->format('d/m/Y H:i') }}
                        </small>
                    </div>
                    @endforeach
                </div>
                @else
                <p class="text-center text-muted">Aún no hay observaciones registradas.</p>
                @endif
            </div>
        </div>
    </div>
</div>



<div class="d-flex justify-content-end gap-2 mt-4">
    <hr>
    <x-boton-principal href="{{ route('estudiantes.index') }}">
        <i class="fas fa-arrow-left me-1"></i> Volver
    </x-boton-principal>
    <x-boton-principal href="{{ route('estudiantes.edit', $estudiante->id) }}">
        <i class="fas fa-edit me-1"></i> Editar
    </x-boton-principal>
</div>
@endsection
@if ($errors->any())
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var modalObservacion = new bootstrap.Modal(document.getElementById('modalObservacion'));
        modalObservacion.show();
    });
</script>
@endif