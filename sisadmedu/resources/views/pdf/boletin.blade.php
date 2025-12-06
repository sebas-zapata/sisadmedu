<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Boletín de Notas</title>
    <link href="{{ public_path('css/estilos-pdf/boletin.css') }}" rel="stylesheet">
</head>

<body>

    <!-- Encabezado -->
    <div class="header">
        <img src="{{ public_path('images/Logo SISADMEDU.jpg') }}" class="logo">

        <div class="title">Boletín de Notas</div>
        <div class="sub-title">
            {{ $periodo->nombre_periodo }} | {{ $periodo->numero_periodo }} -
            {{ now()->locale('es')->isoFormat('DD/MM/YYYY') }}

        </div>
    </div>

    <!-- Datos del estudiante -->
    <div class="info-box">
        <p><strong>Estudiante:</strong>
            {{ $estudiante->primer_nombre_estudiante }}
            {{ $estudiante->segundo_nombre_estudiante }}
            {{ $estudiante->primer_apellido_estudiante }}
            {{ $estudiante->segundo_apellido_estudiante }}
        </p>

        <p><strong>Documento:</strong> {{ $estudiante->usuario->documento }}</p>
        <p><strong>Grado:</strong> {{ $estudiante->grado->nombre_grado }}</p>
        <p><strong>Código Matrícula:</strong> {{ $estudiante->matricula }}</p>
    </div>

    <!-- Materias y notas -->
    @foreach($materias as $asignacion)
    @php
    $nota = $notasExistentes[$asignacion->id];
    @endphp

    <div class="materia-title">
        {{ $asignacion->materia->descripcion }}
    </div>

    @if($nota && count($nota['detalles']) > 0)

    <table>
        <thead>
            <tr>
                <th>Actividad / Descripción</th>
                <th>Valor</th>
            </tr>
        </thead>
        <tbody>
            @foreach($nota['detalles'] as $d)
            <tr>
                <td>{{ $d['nombre_detalle'] }}</td>
                <td>{{ number_format($d['valor'], 1) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <table>
        <tbody>
            <tr>
                <th style="width: 70%;">Promedio Final</th>
                <td><strong>{{ number_format($nota['promedio'], 1) }}</strong></td>
            </tr>
            <tr>
                <th>Estado</th>
                <td>
                    <span class="{{ $nota['promedio'] >= 3 ? 'aprobado' : 'reprobado' }}">
                        {{ $nota['promedio'] >= 3 ? 'Aprobó' : 'Reprobó' }}
                    </span>
                </td>
            </tr>
        </tbody>
    </table>

    @else
    <p style="color: #888; margin-left: 5px;">No hay notas asignadas.</p>
    @endif

    @endforeach

    <footer>
        Sistema SISADMEDU — Documento generado automáticamente el {{ now()->format('d/m/Y') }}
    </footer>

</body>

</html>