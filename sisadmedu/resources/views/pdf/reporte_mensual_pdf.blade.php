<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Reporte Mensual de Asistencias</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #000; padding: 4px; text-align: center; }
        th { background: #eee; }
    </style>
</head>
<body>
    <h3 style="text-align:center;">Reporte Mensual de Asistencias</h3>
    <p><strong>Materia:</strong> {{ $asignacion->materia->descripcion }}</p>
    <p><strong>Mes:</strong> {{ ucfirst(\Carbon\Carbon::create($anio, $mes)->locale('es')->monthName) }} {{ $anio }}</p>

    <table>
        <thead>
            <tr>
                <th>Estudiante</th>
                @foreach ($diasDelMes as $dia)
                    <th>{{ $dia }}</th>
                @endforeach
                <th>P</th><th>A</th><th>T</th><th>E</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($asignacion->grado->estudiantes as $estudiante)
                @php
                    $presentes = $ausentes = $tardes = $excusas = 0;
                @endphp
                <tr>
                    <td>{{ $estudiante->primer_nombre_estudiante }} {{ $estudiante->primer_apellido_estudiante }}</td>
                    @foreach ($diasDelMes as $dia)
                        @php
                            $fecha = \Carbon\Carbon::createFromDate($anio, $mes, $dia)->format('Y-m-d');
                            $registro = $asistencias[$estudiante->id]->firstWhere('fecha', $fecha) ?? null;
                        @endphp
                        <td>
                            @if ($registro)
                                @switch($registro->estado)
                                    @case('presente') P @php $presentes++; @endphp @break
                                    @case('ausente') A @php $ausentes++; @endphp @break
                                    @case('tarde') T @php $tardes++; @endphp @break
                                    @case('excusa') E @php $excusas++; @endphp @break
                                @endswitch
                            @else - @endif
                        </td>
                    @endforeach
                    <td>{{ $presentes }}</td>
                    <td>{{ $ausentes }}</td>
                    <td>{{ $tardes }}</td>
                    <td>{{ $excusas }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
