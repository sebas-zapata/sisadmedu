<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'SISADMEDU') }}</title>

    {{-- Bootstrap CSS desde CDN --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Estilos personalizados --}}
    <link href="{{ asset('css/estilos.css') }}" rel="stylesheet">
</head>
<body class="bg-light text-dark">

    <div class="container bg-dark  min-vh-100 d-flex flex-column justify-content-center align-items-center py-5">
        
        {{-- Logo --}}
        <div class="text-center mb-4">
            <img src="{{ asset('images/Logo SISADMEDU.jpg') }}" alt="Logo" class="img-thumbnail rounded-circle shadow" width="140">
        </div>

        {{-- Contenido dinámico --}}
        <div class="card shadow w-100" style="max-width: 420px;">
            <div class="card-body">
                {{ $slot }}
            </div>
        </div>
    </div>

    {{-- Bootstrap JS (opcional si usas modales, dropdowns, etc.) --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
