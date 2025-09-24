@extends('layouts.app')
@section('contenido')
    <h2 class="text-center text-light">@yield('titulo')</h2>
    <div class="contenedor">
        @yield('informacion')
    </div>
@endsection