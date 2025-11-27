@extends('layouts.app')
@section('contenido')
<div class="container-fluid p-2">
    <h2 class="text-center text-light">@yield('titulo')</h2>
    <div class="container-fluid p-3 contenedor-componente">
        <div class="container-fluid">

            {{-- BARRA DE ACCIONES SUPER RESPONSIVA --}}
            <div class="d-flex flex-column flex-md-row justify-content-center justify-content-md-between 
                align-items-center gap-3 mb-3 text-center text-md-start">

                {{-- Botones --}}
                <div class="d-flex flex-wrap gap-2 justify-content-center justify-content-md-start">
                    @yield('acciones')
                </div>

                {{-- Filtros --}}
                <div class="d-flex flex-wrap gap-2 justify-content-center justify-content-md-end">
                    @yield('filtros')
                </div>

            </div>

        </div>

        <div class="table-responsive text-center m-1">
            @yield('tabla')
        </div>
    </div>
</div>
@endsection