@extends('layouts.app')
@section('contenido')
<div class="container py-4">
    <h2 class="text-center text-light"><i class="fas fa-user-circle me-2"></i> Usuario @yield('titulo')</h2><hr>
    <div class="card shadow-lg border-0 rounded-4 p-4">
        @yield('informacion')
    </div>
</div>
@endsection