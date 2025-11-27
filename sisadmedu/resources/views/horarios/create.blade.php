{{-- resources/views/horarios/create.blade.php --}}
@extends('layouts.gestion')

@section('titulo')
<i class="fa-solid fa-calendar-days"></i> Nuevo Horario <span class="badge bg-secondary">{{ $gradoSeleccionado->nombre_grado }}</span>
@endsection

@section('tabla')

<form action="{{ route('horarios.store') }}" method="POST">
    @csrf

    @section('acciones')
    @if($gradoSeleccionado)
    <input type="hidden" name="id_grado" value="{{ $gradoSeleccionado->id }}">
    @endif

    <x-boton-principal type="submit">
        <i class="fa-solid fa-calendar-days"></i> Guardar Horario
    </x-boton-principal>
    @endsection


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
        <table class="table table-bordered table-hover align-middle text-center shadow-sm" style="table-layout: fixed;">
            <thead class="table-secondary sticky-top">
                <tr>
                    <th class="text-center align-middle" style="width: 100px;">Materia #</th>
                    @foreach($dias as $dia)
                    <th class="text-center align-middle">{{ $dia }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @php $materiaCounter = 0; @endphp

                @foreach($bloques as $i => $bloque)
                @if(isset($bloque['descanso']))

                {{-- Fila de descanso --}}
                <tr class="table-warning text-center fw-bold align-middle">
                    <td class="text-truncate" style="min-width: 80px;">Descanso</td>
                    @foreach($dias as $dia)
                    <td class="p-1">
                        <span class="badge bg-secondary d-inline-block text-truncate w-100"
                            style="min-width: 60px;">
                            {{ $bloque['inicio'] }} - {{ $bloque['fin'] }}
                        </span>
                    </td>
                    @endforeach
                </tr>

                @else
                {{-- Fila de materia --}}
                <tr class="align-middle" style="background-color: #f9f9f9;">
                    <td class="fw-bold" style="background-color: #e9ecef;">Materia {{ $materiaCounter + 1 }}</td>
                    @foreach($dias as $d => $dia)
                    @php
                    $materiaIndex = ($materiaCounter + $d) % $totalMaterias;
                    $materiaPredefinida = $materiasArray[$materiaIndex];
                    @endphp
                    <td class="p-2">
                        {{-- Select Materia --}}
                        <select name="materias[{{ $dia }}][]" class="form-select form-select-sm mb-1" required>
                            @foreach($materias as $materia)
                            <option value="{{ $materia->id }}"
                                @if($materia->id == $materiaPredefinida) selected @endif>
                                {{ $materia->descripcion }}
                            </option>
                            @endforeach
                        </select>
                        @error("materias.$dia.$materiaCounter")
                        <div class="text-danger small">{{ $message }}</div>
                        @enderror

                        {{-- Mostrar horas fijas --}}
                        <div class="small text-muted mt-1">
                            {{ $bloque['inicio'] }} - {{ $bloque['fin'] }}
                        </div>

                        {{-- Inputs hidden --}}
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