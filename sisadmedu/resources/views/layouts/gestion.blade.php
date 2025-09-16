@extends('layouts.app')
@section('contenido')
<div class="container-fluid p-2">
    <h2 class="text-center text-light">@yield('titulo')</h2>
<div class="container-fluid p-3 contenedor-componente">
    <div class="d-flex justify-content-between align-items-center mb-2">
        @yield('boton-registrar')
    </div>
    <div class="table-responsive text-center m-1">
        @yield('tabla')
        <div class="d-flex justify-content-end">
            @yield('paginacion')
        </div>
    </div>
</div>
</div>
@endsection