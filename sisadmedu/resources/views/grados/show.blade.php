    @extends('layouts.show')

    @section('titulo', 'Estudiantes del grado ' . $grado->nombre_grado)

    @section('informacion')
    <div class="container py-4">
        <h2 class="text-center text-light">@yield('titulo')</h2>
        <div class=" shadow-lg border-0 rounded-4 p-4">
            @section('informacion')
            @if($grado->estudiantes->isEmpty())
            <p class="text-center text-light">No hay estudiantes registrados en este grado.</p>
            @else
            <div class="row">
                <input
                    type="text"
                    class="form-control w-75"
                    id="filtroNombre"
                    placeholder="Filtrar por nombre"
                    pattern="[A-Za-z\s]*"></input>
                @foreach($grado->estudiantes as $est)
                <div class="columna-estudiante col-md-6 col-lg-4 mb-2" data-nombre="{{ strtolower($est->primer_nombre_estudiante . ' ' . $est->primer_apellido_estudiante) }}">
                    <div class="tarjeta-estudiante sombra h-100">

                        <!-- Encabezado -->
                        <div class="encabezado-estudiante text-white text-center">
                            <h5 class="mb-0 nombre-estudiante">
                                {{ $est->primer_nombre_estudiante }} {{ $est->primer_apellido_estudiante }}
                            </h5>
                            <small class="matricula-estudiante d-block">Matrícula: {{ $est->matricula }}</small>
                        </div>

                        <!-- Cuerpo -->
                        <div class="cuerpo-estudiante text-center">
                            <p class="dato-estudiante">
                                <i class="fas fa-id-badge"></i>
                                <strong>Documento:</strong> {{ $est->usuario->documento }}
                            </p>
                            <p class="dato-estudiante">
                                <i class="fas fa-calendar-alt"></i>
                                <strong>Edad:</strong> {{ $est->edad_estudiante }} años
                            </p>
                            <p class="dato-estudiante">
                                <i class="fas fa-envelope"></i>
                                <strong>Correo:</strong> {{ $est->usuario->correo_electronico}}
                            </p>
                        </div>
                    </div>
                </div>


                @endforeach
            </div>
            @endif
        </div>
        @endsection
    </div>
    @endsection