@extends('layouts.app')
@section('contenido')
<div class="container-fluid p-2">
    <h2 class="text-center text-light">@yield('titulo')</h2>
<div class="container-fluid p-3 contenedor-componente">
    @yield('boton-registrar')
    <div class="table-responsive text-center m-1">
        @yield('tabla')
        <div class="d-flex justify-content-end">
            @yield('paginacion')
        </div>
    </div>
</div>
</div>
@endsection