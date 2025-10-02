@extends('layouts.show')

@section('titulo')

<h2 class="text-center text-light mb-4">
    <i class="fas fa-book"></i> {{ $materia->descripcion }}
</h2>
<p class="text-center text-light mb-4">Docentes que imparten esta materia</p>

@endsection

@section('informacion')
<div class="shadow-lg border-0 rounded-4 p-4">

    {{-- Verificar si la materia tiene docentes asignados --}}
    @if($materia->docentes->isEmpty())
    <p class="text-center text-light">No hay docentes asignados a esta materia.</p>
    @else
    <div class="table-responsive shadow-sm">
        <table class="table table-bordered table-hover align-middle text-center">
            <thead class="text-center">
                <tr>
                    <th style="width: 15%">ID Documento</th>
                    <th style="width: 25%">Nombres</th>
                    <th style="width: 25%">Apellidos</th>
                    <th style="width: 35%">Correo</th>
                </tr>
            </thead>
            <tbody>
                @forelse($materia->docentes as $doc)
                <tr>
                    <td class="text-center fw-bold">
                        {{ $doc->usuario->documento ?? 'N/A' }}
                    </td>
                    <td>
                        {{ $doc->primer_nombre }} {{ $doc->segundo_nombre }}
                    </td>
                    <td>
                        {{ $doc->primer_apellido }} {{ $doc->segundo_apellido }}
                    </td>
                    <td>
                        {{ $doc->usuario->correo_electronico ?? 'Sin correo' }}
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center text-muted py-3">
                        <i class="fas fa-chalkboard-teacher"></i>
                        No hay docentes asignados a esta materia.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @endif

</div>
@endsection