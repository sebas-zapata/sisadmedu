@extends('layouts.app');

@section('content')
<div class="container-fluid p-2">
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif
    <h2 class="text-center text-light">Editar Perfil <i class="fas fa-user-edit"></i></h2>
<form method="POST" action="{{ route('perfil.update') }}">
    @csrf
    @method('PUT')

    <div>
        <label>Nombres</label>
        <input type="text" name="nombres" value="{{ old('nombres', $usuario->nombres) }}">
    </div>

    <div>
        <label>Apellidos</label>
        <input type="text" name="apellidos" value="{{ old('apellidos', $usuario->apellidos) }}">
    </div>

    <div>
        <label>Correo electrónico</label>
        <input type="email" name="correo_electronico" value="{{ old('correo_electronico', $usuario->correo_electronico) }}">
    </div>

    <div>
        <label>Teléfono</label>
        <input type="text" name="telefono" value="{{ old('telefono', $usuario->telefono) }}">
    </div>

    <div>
        <label>Contraseña (opcional)</label>
        <input type="password" name="contrasena">
    </div>

    <button type="submit">Actualizar</button>
</form>
</div>
<div class="container-fluid p-3 contenedor-componente">
    <x-boton-principal href="{{ route('dashboard') }}">
        <i class="fas fa-arrow-left"></i> Volver al Panel
    </x-boton-principal>
@endsection
