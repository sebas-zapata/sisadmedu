@extends('layouts.app')
@section('contenido')
<div class="container py-4">
    <h2 class="text-center text-light">@yield('titulo')</h2>
    <div class="card shadow-lg border-0 rounded-4 p-4">
        @yield('informacion')
    </div>
</div>
@endsection