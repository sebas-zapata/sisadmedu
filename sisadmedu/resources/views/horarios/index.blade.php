{{-- resources/views/horarios/index.blade.php --}}
@extends('layouts.gestion')

@section('titulo')
<i class="fa-solid fa-calendar-days"></i> Gestión de Horarios
@endsection

@section('boton-registrar')
<!-- Input de búsqueda -->
<div class="container-fluid d-flex justify-content-end">
    <div class="mb-3">
        <input type="text" id="filtroGrados" class="form-control w-75" placeholder="Filtrar por nivel">
    </div>
</div>

@endsection

@section('tabla')
<div class="card shadow-sm border-0">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle text-center tabla-horario" id="tabla-horario">
                <thead class=" text-uppercase">
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Grado</th>
                        <th scope="col">Horario</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($grados as $grado)
                    @php
                    $tieneHorario = $grado->horarios()->exists();
                    @endphp
                    <tr data-nombre="{{ $grado->nombre_grado}}">
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $grado->nombre_grado }}</td>
                        <td>
                            @if($tieneHorario)
                            <span class="badge bg-dark">Asignado</span>
                            @else
                            <span class="badge bg-secondary">No asignado</span>
                            @endif
                        </td>
                        <td class="d-flex justify-content-center gap-2">
                            @if($tieneHorario)
                            <x-boton-accion tipo="ver" href="{{ route('horarios.show', $grado->id) }}" />
                            <x-boton-accion tipo="editar" href="{{ route('horarios.edit', $grado->id) }}" />
                            <form action="{{ route('horarios.destroy', $grado->id) }}"
                                method="POST"
                                class="d-inline-block"
                                data-horario="{{ $grado->nombre_grado }}">
                                @csrf
                                @method('DELETE')
                                <x-boton-accion class="btn-eliminar-horario" type="button">
                                    <i class="fa-solid fa-trash"></i>
                                </x-boton-accion>
                            </form>
                            @else
                            <x-boton-principal href="{{ route('horarios.create', ['grado' => $grado->id]) }}">
                                <i class="fa-solid fa-calendar-days"></i>
                            </x-boton-principal>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection