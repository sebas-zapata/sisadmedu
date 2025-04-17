<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Usuarios</title>

    {{-- Estilos de Vite (si usas Laravel Breeze, Jetstream o Tailwind directamente) --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 text-gray-800 min-h-screen flex flex-col">

    {{-- Barra de Navegación personalizada --}}
    @include('layouts.navigation')

    {{-- Contenido principal --}}
    <main class="flex-1 max-w-7xl mx-auto w-full px-4 sm:px-6 lg:px-8 py-6">
        @yield('content')
    </main>

    {{-- Footer --}}
    <footer class="bg-white border-t mt-auto py-4">
        <div class="text-center text-sm text-gray-500">
            © {{ date('Y') }} Sistema de Gestión de Usuarios
        </div>
    </footer>

</body>
</html>
