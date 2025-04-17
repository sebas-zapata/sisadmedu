<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Usuarios</title>
    <link href="{{ asset('css/estilos.css') }}" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    {{-- Estilos de Vite (si usas Laravel Breeze, Jetstream o Tailwind directamente) --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>

    {{-- Barra de Navegación personalizada --}}
    @include('layouts.navigation')

    {{-- Contenido principal --}}
    <main>
        @yield('content')
    </main>

</body>
</html>
