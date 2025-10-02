{{-- resources/views/horarios/show.blade.php --}}
@extends('layouts.gestion')

@section('titulo')
<i class="fa-solid fa-calendar-days"></i> Horario del Grado <span class="badge bg-light text-dark">{{ $grado->nombre_grado }}</span>
@endsection

@section('tabla')

<div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
</div>

@php
    $dias = ['Lunes','Martes','Miércoles','Jueves','Viernes'];

    // Bloques de la jornada (con descanso incluido)
    $bloques = [
        ['inicio' => '06:00', 'fin' => '07:38'], // Bloque 1
        ['inicio' => '07:38', 'fin' => '09:15'], // Bloque 2
        ['descanso' => true, 'inicio' => '09:15', 'fin' => '09:45'], // Descanso
        ['inicio' => '09:45', 'fin' => '10:45'], // Bloque 3
        ['inicio' => '10:45', 'fin' => '11:45'], // Bloque 4
    ];

    $totalBloques = count($bloques);
@endphp

<div class="table-responsive">
    <table class="table table-bordered table-hover align-middle text-center">
        <thead class="table-light">
            <tr>
                <th class="align-middle">Asignaturas</th>
                @foreach($dias as $dia)
                    <th class="align-middle">{{ $dia }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @for($i = 0; $i < $totalBloques; $i++)
                @php
                    $bloque = $bloques[$i];
                @endphp

                {{-- FILA DE DESCANSO --}}
                @if(isset($bloque['descanso']))
                    <tr class="table-warning text-center fw-bold align-middle">
                        <td class="text-truncate" style="min-width: 80px;">Descanso</td>
                        @foreach($dias as $dia)
                            <td class="p-1">
                                <span class="badge bg-secondary d-inline-block text-truncate w-100" style="min-width: 60px;">
                                    {{ $bloque['inicio'] }} - {{ $bloque['fin'] }}
                                </span>
                            </td>
                        @endforeach
                    </tr>
                @else
                    {{-- FILA DE MATERIA --}}
                    <tr class="align-middle">
                        <td class="fw-bold">Asignatura {{ $i + 1 }}</td>
                        @foreach($dias as $dia)
                            @php
                                $horariosDia = $horarios[$dia] ?? collect();
                                $horarioExistente = $horariosDia[$i] ?? null;
                                $materia = $horarioExistente->materia ?? null;
                            @endphp
                            <td class="p-1 text-truncate" style="min-width: 120px;">
                                @if($materia)
                                    <div class="fw-bold text-truncate">{{ $materia->descripcion }}</div>
                                @else
                                    <span class="text-muted small">Sin asignar</span>
                                @endif
                                <div class="text-muted small">{{ $bloque['inicio'] }} - {{ $bloque['fin'] }}</div>
                            </td>
                        @endforeach
                    </tr>
                @endif
            @endfor
        </tbody>
    </table>
</div>

@endsection
