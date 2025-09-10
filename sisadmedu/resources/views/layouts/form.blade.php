{{-- resources/views/layouts/formulario.blade.php --}}
@extends('layouts.app')

@section('contenido')
<div class="container py-4">
    <h2 class="mb-4 text-light text-center">
        @yield('titulo-formulario')
    </h2>
    <hr>
    <form id="@yield('id-form')" action="@yield('ruta-accion')" method="POST" novalidate>

        @csrf
        @yield('metodo') {{-- Para usar @method('PUT') en edit --}}
        
        {{-- CAMPOS DEL FORMULARIO --}}
        @yield('campos-formulario')

        <div class="d-flex justify-content-end">
            @yield('botones-formulario')
        </div>
    </form>
</div>
@endsection
