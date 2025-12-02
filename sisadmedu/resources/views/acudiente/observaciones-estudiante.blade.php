@extends('layouts.show')

@section('titulo')
<p class="fs-2 mt-2">
    Observaciones del estudiante: <span class="badge bg-secondary">{{ $totalObservaciones }}</span>
</p>

@endsection

@section('informacion')
<div class="container py-4">

    <div class="shadow-lg border-0 rounded-4 p-4">
        @if($observaciones->isEmpty())
            <p class="text-center text-light">Tu estudiante no tiene observaciones registradas.</p>
        @else
            <div class="row">
                @foreach($observaciones as $obs)
                    <div class="col-md-6 col-lg-4 mb-3">
                        <div class="tarjeta-estudiante sombra h-100">

                            <!-- Encabezado -->
                            <div class="encabezado-estudiante text-white text-center
                                {{ strtolower($obs->tipo) === 'positiva' ? 'bg-success' : (strtolower($obs->tipo) === 'negativa' ? 'bg-danger' : 'bg-secondary') }}">
                                <h5 class="mb-0 text-uppercase">{{ ucfirst($obs->tipo) }}</h5>
                            </div>

                            <!-- Cuerpo -->
                            <div class="cuerpo-estudiante text-center p-3">
                                <p class="dato-estudiante">
                                    <i class="fas fa-user-tie"></i>
                                    <strong>Docente:</strong>
                                    {{ $obs->docente->primer_nombre ?? 'No disponible' }}
                                    {{ $obs->docente->primer_apellido ?? '' }}
                                </p>

                                <p class="dato-estudiante">
                                    <i class="fas fa-align-left"></i>
                                    <strong>Descripción:</strong>
                                    {{ $obs->descripcion }}
                                </p>

                                <p class="dato-estudiante text-muted">
                                    <i class="fas fa-calendar-alt"></i>
                                    <strong>Fecha:</strong>
                                    {{ $obs->created_at->format('d/m/Y H:i') }}
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>
@endsection
