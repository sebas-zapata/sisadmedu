@extends('layouts.app')

@section('content')
    <div class="mb-4">
        <h2 class="h4">{{ __('Dashboard') }}</h2>
    </div>

    <div class="card">
        <div class="card-body">
            <a href="{{ route('usuarios.index') }}">Gestionar Usuarios</a>
        </div>
    </div>
@endsection
