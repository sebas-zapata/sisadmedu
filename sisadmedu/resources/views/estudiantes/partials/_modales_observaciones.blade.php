<!-- Modal: Nueva Observación -->
<div class="modal fade" id="modalObservacion" tabindex="-1" aria-labelledby="modalObservacionLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header text-white">
                <h5 class="modal-title" id="modalObservacionLabel">Nueva Observación</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form action="{{ route('observacion.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="estudiante_id" value="{{ $estudiante->id }}">

                    @if(Auth::user()->rol->nombre === 'Docente' && Auth::user()->docente)
                    <input type="hidden" name="docente_id" value="{{ Auth::user()->docente->id }}">
                    @endif

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

                    <div class="form-floating mb-3">
                        <textarea name="descripcion" id="descripcion" class="form-control @error('descripcion') is-invalid @enderror" style="height: 120px">{{ old('descripcion') }}</textarea>
                        <label for="descripcion">Descripción</label>
                        @error('descripcion')
                        <div class="text-danger mt-1 px-2 py-1" style="background-color:#ffe6e6; border-radius:4px;">{{ $message }}</div>
                        @enderror
                    </div>

                </div>

                <div class="modal-footer">
                    <x-boton-principal type="button" data-bs-dismiss="modal">Cancelar</x-boton-principal>

                    <x-boton-principal type="submit">
                        <i class="fas fa-save me-1"></i> Guardar
                    </x-boton-principal>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- Modal: Ver Observaciones -->
<div class="modal fade" id="modalVerObservaciones" tabindex="-1" aria-labelledby="modalVerObservacionesLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">

            <div class="modal-header text-white">
                <h5 class="modal-title fw-bold" id="modalVerObservacionesLabel">Observaciones del Estudiante</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>

            <div class="modal-body">

                @if($estudiante->observaciones->isNotEmpty())

                <div class="list-group">

                    @foreach($estudiante->observaciones as $obs)

                    <div class="list-group-item">

                        <div class="mb-2">
                            <strong class="text-uppercase">{{ ucfirst($obs->tipo) }}:</strong>
                            {{ $obs->descripcion }}
                        </div>

                        <small class="text-muted d-block mb-2">
                            Por: {{ $obs->docente->primer_nombre }} {{ $obs->docente->primer_apellido }}
                            | {{ $obs->created_at->format('d/m/Y H:i') }}
                        </small>

                        <!-- BOTÓN EDITAR -->
                        <x-boton-accion tipo="editar"
                            data-bs-target="#modalEditarObservacion{{ $obs->id }}">
                        </x-boton-accion>

                        <form action="{{ route('observacion.delete', $obs->id) }}" method="POST" class="d-inline-block">
                            @csrf
                            @method('DELETE')
                            <!--Volver a la misma vista con el id especifico del estudiante actual-->
                            
                            <input type="hidden" name="estudiante_id" value="{{ $estudiante->id }}">
                            <!-- BOTON ELIMINAR -->
                            <x-boton-accion tipo="eliminar" class="btn-eliminar-observacion">
                            </x-boton-accion>

                        </form>

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