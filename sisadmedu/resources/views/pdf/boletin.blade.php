<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Boletín de Notas</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            margin: 30px;
            color: #333;
        }

        .header {
            text-align: center;
            margin-bottom: 25px;
        }

        .logo {
            height: 80px;
            margin-bottom: 10px;
        }

        .title {
            font-size: 20px;
            font-weight: bold;
            margin: 5px 0;
            text-transform: uppercase;
            color: #2c3e50;
        }

        .sub-title {
            font-size: 13px;
            color: #555;
        }

        .info-box {
            border: 1px solid #ccc;
            padding: 10px 15px;
            border-radius: 6px;
            margin-bottom: 25px;
            background: #fafafa;
        }

        .info-box p {
            margin: 4px 0;
            font-size: 13px;
        }

        .materia-title {
            background: #461c68;
            padding: 6px 10px;
            color: white;
            font-size: 14px;
            margin-top: 20px;
            border-radius: 4px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 8px;
            margin-bottom: 15px;
        }

        table th {
            background: #eee;
            padding: 6px;
            border: 1px solid #ccc;
            font-weight: bold;
            text-align: left;
            font-size: 12px;
        }

        table td {
            padding: 6px;
            border: 1px solid #ccc;
            font-size: 12px;
        }

        .aprobado {
            color: green;
            font-weight: bold;
        }

        .reprobado {
            color: red;
            font-weight: bold;
        }

        footer {
            margin-top: 25px;
            text-align: center;
            font-size: 11px;
            color: #666;
        }
    </style>
</head>

<body>

    <!-- Encabezado -->
    <div class="header">
        <img src="{{ public_path('images/Logo SISADMEDU.jpg') }}" class="logo">

        <div class="title">Boletín de Notas</div>
        <div class="sub-title">
            {{ $periodo->nombre_periodo }} | {{ $periodo->numero_periodo }} -
            {{ now()->locale('es')->isoFormat('MMMM YYYY') }}
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