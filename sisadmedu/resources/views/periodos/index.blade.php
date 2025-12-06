@extends('layouts.gestion')

@section('titulo')
        <i class="fa-solid fa-calendar"></i>
        Gestión de Periodos Académicos
@endsection

@section('tabla')
<div class="card shadow card-custom border-0">

    <div class="card-body">

        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-light">
                    <tr class="text-center">
                        <th>#</th>
                        <th>Nombre</th>
                        <th>Número</th>
                        <th>Fecha Inicio</th>
                        <th>Fecha Fin</th>
                        <th>Estado</th>
                        <th>Acción</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($periodos as $p)
                    <tr class="text-center">
                        <td>{{ $p->id }}</td>
                        <td>{{ $p->nombre_periodo }}</td>
                        <td>{{ $p->numero_periodo }}</td>
                        <td>{{ $p->fecha_inicio }}</td>
                        <td>{{ $p->fecha_fin }}</td>
                        <td>
                            @if($p->activo)
                                <span style="background-color: #461c68;" class="badge">Activo</span>
                            @else
                                <span class="badge bg-secondary">Inactivo</span>
                            @endif
                        </td>
                        <td>
                            <form method="POST" action="{{ route('periodos.estado', $p->id) }}">
                                @csrf
                                <label class="switch">
                                    <input type="checkbox" onchange="this.form.submit()" {{ $p->activo ? 'checked' : '' }}>
                                    <span class="slider"></span>
                                </label>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>

            </table>
        </div>

    </div>
</div>

@endsection
