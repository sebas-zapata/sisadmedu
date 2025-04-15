<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Usuarios</title>

    {{-- Estilos de Bootstrap --}}
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"> -->

    {{-- Estilos de Vite (si usas Laravel Breeze/Inertia) --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>

    {{-- Barra de Navegación personalizada --}}
    @include('layouts.navigation')

    {{-- Contenido principal --}}
    <div class="container mt-4">
        @yield('content')
    </div>

    {{-- Footer --}}
    <footer class="text-center mt-5 py-3 bg-light">
        <div class="container">
            <span class="text-muted">© {{ date('Y') }} Sistema de Gestión de Usuarios</span>
        </div>
    </footer>

    {{-- Scripts de Bootstrap --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
