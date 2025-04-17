@extends('layouts.app')

@section('content')
    <div class="mb-6">
        <h2 class="text-2xl font-semibold text-gray-800">{{ __('Dashboard') }}</h2>
    </div>

    <div class="bg-white shadow-md rounded-lg p-6">
        <a href="{{ route('usuarios.index') }}" 
           class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-4 rounded-md transition duration-200">
            Gestionar Usuarios
        </a>
    </div>
@endsection
