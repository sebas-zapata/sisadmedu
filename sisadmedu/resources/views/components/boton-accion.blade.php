@props([
    'tipo' => '',          // ver, editar, eliminar
    'href' => null,        // Si hay href, se usa <a>; si no, <button>
    'type' => 'button',    // type del botón si no es enlace
    'class' => '',         // clases adicionales
])

@php
    $iconos = [
        'ver' => 'fa-eye',
        'editar' => 'fa-pen',
        'eliminar' => 'fa-trash',
        'descargar' => 'fa-file-pdf',
    ];
    $icono = $iconos[$tipo] ?? ''; 
    $estilos = [
        'ver' => 'btn-ver',
        'editar' => 'btn-editar',
        'eliminar' => 'btn-eliminar',
        'descargar' => 'btn-descargar',
    ];
    $estilo = $estilos[$tipo] ?? 'btn-accion-default';
    $title = ucfirst($tipo);
@endphp

@if ($href && $tipo !== 'eliminar')
    {{-- Renderiza un enlace si hay href y no es "eliminar" --}}
    <a href="{{ $href }}"
       title="{{ $title }}"
       {{ $attributes->merge(['class' => "btn-accion $estilo $class"]) }}>
        @if ($icono)<i class="fas {{ $icono }}"></i>@endif
        {{ $slot }}
    </a>
@else
    {{-- Renderiza un botón para eliminar o cuando no hay href --}}
    <button type="{{ $type }}"
        title="{{ $title }}"
        {{ $attributes->merge(['class' => "btn-accion $estilo $class"]) }}>
        @if ($icono)<i class="fas {{ $icono }}"></i>@endif
        {{ $slot }}
    </button>
@endif
