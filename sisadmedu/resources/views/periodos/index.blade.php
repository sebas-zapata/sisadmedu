@extends('layouts.gestion')

@section('titulo')
        <i class="fa-solid fa-calendar"></i>
        Gestión de Periodos Académicos
@endsection

@section('tabla')

<style>
    /* Estilos del contenedor principal */
    .card-custom {
        border-radius: 12px;
        overflow: hidden;
    }

    .card-header-custom {
        background: linear-gradient(90deg, #461c68, #6a2c91);
        font-size: 1.2rem;
        font-weight: 600;
        padding: 18px;
    }

    /* Switch moderno */
    .switch {
        position: relative;
        display: inline-block;
        width: 55px;
        height: 28px;
    }

    .switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }

    .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #dc3545;
        transition: 0.4s;
        border-radius: 34px;
        box-shadow: inset 0 0 5px rgba(0, 0, 0, 0.25);
    }

    .slider:before {
        position: absolute;
        content: "";
        height: 22px;
        width: 22px;
        left: 3px;
        bottom: 3px;
        background-color: white;
        transition: 0.4s;
        border-radius: 50%;
    }

    input:checked + .slider {
        background-color: #28a745;
    }

    input:checked + .slider:before {
        transform: translateX(26px);
    }

    /* Tabla más elegante */
    table th {
        text-align: center;
    }

    table td {
        vertical-align: middle;
    }

    @media (max-width: 768px) {
        .table-responsive {
            font-size: 0.9rem;
        }

        .switch {
            transform: scale(0.85);
        }
    }
</style>

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
                                <span class="badge bg-success">Activo</span>
                            @else
                                <span class="badge bg-danger">Inactivo</span>
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
