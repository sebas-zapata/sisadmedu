@extends('layouts.gestion')

{{-- ============================= --}}
{{-- FILTROS SUPERIORES           --}}
{{-- ============================= --}}
@section('filtros')

<form id="filtroForm" method="GET" action="{{ route('notas.index') }}"
    class="d-flex flex-column flex-md-row align-items-md-center gap-3 mb-4">

    {{-- SELECT DE GRADO --}}
    <select name="grado_id" class="form-select" style="max-width: 260px;" onchange="enviarFiltro()">
        <option value="">— Selecciona un grado —</option>
        @foreach ($grados as $g)
        <option value="{{ $g->id }}" {{ $grado_id == $g->id ? 'selected' : '' }}>
            {{ $g->nombre_grado }}
        </option>
        @endforeach
    </select>

    {{-- SELECT DE MATERIA --}}
    @if ($grado_id)
    <select name="materia_id" class="form-select" style="max-width: 260px;" onchange="enviarFiltro()">
        <option value="">— Selecciona una materia —</option>
        @foreach ($materias as $m)
        <option value="{{ $m->materia->id }}" {{ $materia_id == $m->materia->id ? 'selected' : '' }}>
            {{ $m->materia->descripcion }}
        </option>
        @endforeach
    </select>
    @endif

    {{-- SELECT DE PERIODO --}}
    @if ($grado_id && $materia_id)
    <select name="periodo_id" class="form-select" style="max-width: 260px;" onchange="enviarFiltro()">
        <option value="">— Selecciona un período —</option>
        @foreach ($periodos as $p)
        <option value="{{ $p->id }}" {{ $periodo_id == $p->id ? 'selected' : '' }}>
            {{ $p->nombre_periodo }}
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
<<<<<<< HEAD
=======

@endsection



{{-- ============================= --}}
{{-- TABLA DE NOTAS              --}}
{{-- ============================= --}}
@section('tabla')

{{-- Mensajes según filtros --}}
@if (empty($grado_id))
    <div class="alert alert-secondary text-center">Selecciona un grado para continuar.</div>

@elseif(!empty($grado_id) && empty($materia_id))
    <div class="alert alert-secondary text-center">Ahora selecciona una materia.</div>



@elseif(empty($periodo_id))
    <div class="alert alert-secondary text-center">Selecciona un período.</div>

@else

{{-- TÍTULO --}}
@section('titulo')
    <i class="fa-solid fa-book me-2"></i>
    {{ $asignacion->materia->descripcion }} — Grado {{ $asignacion->grado->nombre_grado }}

@endsection

{{-- ACCIONES --}}
@section('acciones')
    <x-boton-principal onclick="document.getElementById('formNotas').submit()">
        <i class="fa-solid fa-save me-1"></i> Guardar notas
    </x-boton-principal>

    {{-- Botón de Añadir actividad solo si hay menos de 4 --}}
    @if ($actividades->count() < 4)
        <x-boton-accion
            href="{{ route('actividades.crear', [
                'asignacion_id' => $asignacion->id,
                'periodo_id' => $periodo_id,
                'grado_id' => $grado_id,
                'materia_id' => $materia_id
            ]) }}">
            <i class="fa-solid fa-plus"></i>
        </x-boton-accion>
    @endif
@endsection


{{-- FORMULARIO PARA GUARDAR NOTAS --}}
<form id="formNotas" method="POST" action="{{ route('notas.store') }}">
    @csrf

    <input type="hidden" name="asignacion_id" value="{{ $asignacion->id }}">
    <input type="hidden" name="periodo_id" value="{{ $periodo_id }}">

    <div class="table-responsive mt-4">
        <table class="table table-striped table-hover table-bordered shadow-sm">

            {{-- CABECERA --}}
            <thead class="text-center align-middle" style="background-color: red;">
                <tr>
                    <th class="text-start" style="min-width: 220px;">Estudiantes</th>

                    {{-- Nombres de actividades --}}
                    @foreach ($actividades as $a)
                        <th>
                            <a href="{{ route('actividades.editar', $a->id) }}"
                               class="text-decoration-none fw-semibold text-dark"
                               title="Editar actividad">
                                {{ $a->descripcion }}
                            </a>
                        </th>
                    @endforeach

                    <th class="table-secondary fw-bold">Promedio</th>
                </tr>
            </thead>


            {{-- CUERPO --}}
            <tbody>
            @foreach ($estudiantes as $e)
                <tr>

                    {{-- Estudiante --}}
                    <td class="text-start">
                        <strong>{{ $e->primer_nombre_estudiante }} {{ $e->segundo_nombre_estudiante }} {{ $e->primer_apellido_estudiante }} {{ $e->segundo_apellido_estudiante }}</strong>
                        <br>
                    </td>

                    {{-- Inputs de actividades --}}
                    @foreach ($actividades as $a)

                        @php
                            $key = $e->id . '-' . $a->id;
                            $valor = $notas[$key]->valor ?? '';
                        @endphp

                        <td>
                            <input type="number"
                                   step="0.1"
                                   min="0"
                                   max="5"
                                   class="form-control text-center nota-input"
                                   name="notas[{{ $e->id }}][{{ $a->id }}]"
                                   value="{{ $valor }}"
                                   data-estudiante="{{ $e->id }}"
                                   style="width: 90px; margin: auto;">
                        </td>

                    @endforeach

                    {{-- Promedio --}}
                    <td id="promedio-{{ $e->id }}" class="fw-bold"></td>

                </tr>
            @endforeach
            </tbody>

        </table>
    </div>
</form>

@endif
>>>>>>> 1089c7a (Desarrollo del modulo de notas)

@endsection



{{-- ============================= --}}
{{-- TABLA DE NOTAS              --}}
{{-- ============================= --}}
@section('tabla')

{{-- Mensajes según filtros --}}
@if (empty($grado_id))
<div class="alert alert-secondary text-center">Selecciona un grado para continuar.</div>

@elseif(!empty($grado_id) && empty($materia_id))
<div class="alert alert-secondary text-center">Ahora selecciona una materia.</div>



@elseif(empty($periodo_id))
<div class="alert alert-secondary text-center">Selecciona un período.</div>

@else

{{-- TÍTULO --}}
@section('titulo')
<i class="fa-solid fa-book me-2"></i>
{{ $asignacion->materia->descripcion }} — Grado {{ $asignacion->grado->nombre_grado }}

@endsection

{{-- ACCIONES --}}
@section('acciones')
<x-boton-principal onclick="document.getElementById('formNotas').submit()">
    <i class="fa-solid fa-save me-1"></i> Guardar notas
</x-boton-principal>

{{-- Botón de Añadir actividad solo si hay menos de 4 --}}
@if ($actividades->count() < 4)
<a href="{{ route('actividades.crear', [
        'asignacion_id' => $asignacion->id,
        'periodo_id' => $periodo_id,
        'grado_id' => $grado_id,
        'materia_id' => $materia_id
    ]) }}" 
   class="btn btn-secondary mt-3">
    <i class="fa-solid fa-plus"></i> Añadir actividad
</a>



    @endif
    @endsection


    {{-- FORMULARIO PARA GUARDAR NOTAS --}}
    <form id="formNotas" method="POST" action="{{ route('notas.store') }}">
        @csrf

        <input type="hidden" name="asignacion_id" value="{{ $asignacion->id }}">
        <input type="hidden" name="periodo_id" value="{{ $periodo_id }}">

        <div class="table-responsive mt-4">
            <table class="table table-striped table-hover table-bordered shadow-sm">

                {{-- CABECERA --}}
                <thead class="text-center align-middle" style="background-color: red;">
                    <tr>
                        <th class="text-start" style="min-width: 220px;"><i class="fa-solid fa-users"></i> Estudiantes</th>

                        {{-- Nombres de actividades --}}
                        @foreach ($actividades as $a)
                        <th>
                            <a href="{{ route('actividades.editar', $a->id) }}"
                                class="text-decoration-none fw-semibold text-dark"
                                title="Editar actividad">
                                <i class="fa-solid fa-pen-to-square me-1 text-secondary"></i> <!-- Ícono de editar -->
                                {{ $a->descripcion }}
                            </a>

                        </th>
                        @endforeach

                        <th class="table-secondary fw-bold"><i class="fa-solid fa-chart-column"></i>
                            Promedio</th>
                    </tr>
                </thead>


                {{-- CUERPO --}}
                <tbody>
                    @foreach ($estudiantes as $e)
                    <tr>

                        {{-- Estudiante --}}
                        <td class="text-start">
                            <strong>{{ $e->primer_nombre_estudiante }} {{ $e->segundo_nombre_estudiante }} {{ $e->primer_apellido_estudiante }} {{ $e->segundo_apellido_estudiante }}</strong>
                            <br>
                        </td>

                        {{-- Inputs de actividades --}}
                        @foreach ($actividades as $a)

                        @php
                        $key = $e->id . '-' . $a->id;
                        $valor = $notas[$key]->valor ?? '';
                        @endphp

                        <td>
                            <input type="number"
                                step="0.1"
                                min="0"
                                max="5"
                                class="form-control text-center nota-input"
                                name="notas[{{ $e->id }}][{{ $a->id }}]"
                                value="{{ $valor }}"
                                data-estudiante="{{ $e->id }}"
                                style="width: 90px; margin: auto;">
                        </td>

                        @endforeach

                        {{-- Promedio --}}
                        <td id="promedio-{{ $e->id }}" class="fw-bold"></td>

                    </tr>
                    @endforeach
                </tbody>

            </table>
        </div>
    </form>

    @endif

    @endsection