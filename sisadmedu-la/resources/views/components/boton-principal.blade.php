{{-- resources/views/components/boton-principal.blade.php --}}
@props([
    'type' => 'button',
    'href' => null,
    'class' => '',
])

@if ($href)
    <a href="{{ $href }}" {{ $attributes->merge(['class' => "boton-principal $class"]) }}>
        {{ $slot }}
    </a>
@else
    <button type="{{ $type }}" {{ $attributes->merge(['class' => "boton-principal $class"]) }}>
        {{ $slot }}
    </button>
@endif
