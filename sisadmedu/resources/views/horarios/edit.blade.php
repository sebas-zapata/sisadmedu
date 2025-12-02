{{-- resources/views/horarios/edit.blade.php --}}
@extends('layouts.gestion')

@section('titulo')
Editar Horario <span class="badge bg-secondary text-light">{{ $grado->nombre_grado }}</span>
@endsection

@section('tabla')

<form action="{{ route('horarios.update', $grado->id) }}" method="POST">
    @csrf
    @method('PUT')

    {{-- Encabezado con grado seleccionado y botón de guardar --}}
    <div class="text-start mb-3">
        <x-boton-principal type="submit">
            <i class="fa-solid fa-save me-1"></i> Guardar Cambios
        </x-boton-principal>
    </div>

    @php
        $dias = ['Lunes','Martes','Miércoles','Jueves','Viernes'];
        $materiasArray = $materias->pluck('id')->toArray();
        $totalMaterias = count($materiasArray);

        $bloques = [
            ['inicio' => '06:00', 'fin' => '07:38'],
            ['inicio' => '07:38', 'fin' => '09:15'],
            ['descanso' => true, 'inicio' => '09:15', 'fin' => '09:45'],
            ['inicio' => '09:45', 'fin' => '10:45'],
            ['inicio' => '10:45', 'fin' => '11:45'],
        ];
    @endphp

    <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle text-center shadow-sm">
            <thead class="table-light">
                <tr>
                    <th class="align-middle">Materia #</th>
                    @foreach($dias as $dia)
                        <th class="align-middle">{{ $dia }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @php $materiaCounter = 0; @endphp

                @foreach($bloques as $i => $bloque)
                    @if(isset($bloque['descanso']))
                        {{-- Fila de descanso --}}
                        <tr class="table-warning fw-bold">
                            <td>Descanso</td>
                            @foreach($dias as $dia)
                                <td>
                                    <span class="badge bg-secondary d-inline-block w-100 px-3 py-2">
                                        {{ $bloque['inicio'] }} - {{ $bloque['fin'] }}
                                    </span>
                                </td>
                            @endforeach
                        </tr>
                    @else
                        {{-- Fila de materia --}}
                        <tr>
                            <td><strong>Materia {{ $materiaCounter + 1 }}</strong></td>
                            @foreach($dias as $d => $dia)
                                @php
                                    // Traer la materia asignada para este bloque y día
                                    $horarioExistente = $horarios[$dia][$materiaCounter] ?? null;
                                    $materiaId = $horarioExistente->id_materia ?? $materiasArray[($materiaCounter + $d) % $totalMaterias];
                                @endphp
                                <td class="p-1">
                                    {{-- Select Materia --}}
                                    <select name="materias[{{ $dia }}][]" class="form-select form-select-sm mb-1" required>
                                        @foreach($materias as $materia)
                                            <option value="{{ $materia->id }}"
                                                @if($materia->id == $materiaId) selected @endif>
                                                {{ $materia->descripcion }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error("materias.$dia.$materiaCounter")
                                        <div class="text-danger small">{{ $message }}</div>
                                    @enderror

                                    {{-- Mostrar horas fijas --}}
                                    <div class="small text-muted">
                                        {{ $bloque['inicio'] }} - {{ $bloque['fin'] }}
                                    </div>

                                    {{-- Hidden inputs para enviar las horas --}}
                                    <input type="hidden" name="hora_inicio[{{ $dia }}][]" value="{{ $bloque['inicio'] }}">
                                    <input type="hidden" name="hora_fin[{{ $dia }}][]" value="{{ $bloque['fin'] }}">
                                </td>
                            @endforeach
                        </tr>
                        @php $materiaCounter++; @endphp
                    @endif
                @endforeach
            </tbody>
        </table>
    </div>

</form>
@endsection
