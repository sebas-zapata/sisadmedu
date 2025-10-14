<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Notificación de observación</title>
</head>
<body style="font-family: Arial, sans-serif; background-color:#f9f9f9; padding:20px;">

    <div style="max-width:600px; margin:auto; background:white; padding:20px; border-radius:10px; box-shadow:0 2px 6px rgba(0,0,0,0.1);">

        <h2 style="color:#2c3e50;">📋 Nueva observación registrada</h2>

        <p>Estimado acudiente,</p>

        <p>Se ha registrado una nueva observación para el estudiante:</p>

        <p>
            <strong>{{ $estudiante->primer_nombre_estudiante }} {{ $estudiante->primer_apellido_estudiante }}</strong><br>
            <strong>Tipo:</strong> {{ ucfirst($observacion->tipo) }} <br>
            <strong>Descripción:</strong> {{ $observacion->descripcion }} <br>
            <strong>Docente:</strong> {{ $docente->usuario->nombres }} {{ $docente->usuario->apellidos }}
        </p>

        <p>Fecha: {{ $observacion->created_at->format('d/m/Y H:i') }}</p>

        <p style="margin-top:20px;">Por favor, revise con el estudiante y comuníquese con el docente si requiere aclaraciones.</p>

        <hr style="margin-top:20px;">
        <p style="font-size:12px; color:#7f8c8d;">Este mensaje fue enviado automáticamente por el sistema SISADMEDU.</p>
    </div>

</body>
</html>
