<!DOCTYPE html>
<html>
<head>
    <title>Reporte de Usuarios</title>
    <link href="{{ public_path('css/estilos-pdf/usuarios.css') }}" rel="stylesheet">
</head>
<body>
    <!-- Encabezado -->
    <div class="header">
        <img src="{{ public_path('images/Logo SISADMEDU.jpg') }}" alt="Logo" class="logo">
        <h2>Reporte de Usuarios del Sistema</h2>
        <p>Institución Alfonso López Pumarejo</p>
    </div>

    <!-- Información del reporte -->
    <div class="report-info">
        <strong>Fecha de generación:</strong> {{ \Carbon\Carbon::now()->format('d/m/Y H:i') }}
    </div>

    <!-- Tabla de usuarios -->
    <table>
        <thead>
            <tr>
                <th style="width: 5%;">ID</th>
                <th style="width: 10%;">Documento</th>
                <th style="width: 15%;">Tipo de Documento</th>
                <th style="width: 15%;">Nombres</th>
                <th style="width: 15%;">Apellidos</th>
                <th style="width: 20%;">Correo</th>
                <th style="width: 10%;">Teléfono</th>
                <th style="width: 10%;">Rol</th>
            </tr>
        </thead>
        <tbody>
            @foreach($usuarios as $usuario)
                <tr>
                    <td>{{ $usuario->id }}</td>
                    <td>{{ $usuario->documento }}</td>
                    <td>{{ $usuario->tipoDocumento->descripcion ?? 'Sin tipo' }}</td>
                    <td>{{ $usuario->nombres }}</td>
                    <td>{{ $usuario->apellidos }}</td>
                    <td>{{ $usuario->correo_electronico }}</td>
                    <td>{{ $usuario->telefono }}</td>
                    <td>{{ $usuario->rol->nombre ?? 'Sin rol' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Pie de página -->
    <footer>
        Sistema SISADMEDU - Reporte generado automáticamente
    </footer>
</body>
</html>
