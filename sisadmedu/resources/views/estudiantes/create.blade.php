{{-- resources/views/estudiantes/create.blade.php --}}
@extends('layouts.form')

@section('titulo-formulario')
Crear Estudiante <i class="fas fa-user-graduate"></i>
@endsection

@section('id-form', 'formulario-estudiante')

@section('ruta-accion')
{{ route('estudiantes.store') }}
@endsection

@section('metodo')
@method('POST')
@endsection

@section('campos-formulario')

<div class="row mb-3">
    <div class="col-md-3">
        <div class="form-floating mt-2">
            <select name="id_tipo_documento"
                class="form-select @error('id_tipo_documento') is-invalid @enderror"
                id="id_tipo_documento"
                required>
                <option value="" disabled {{ old('id_tipo_documento') ? '' : 'selected' }}>Selecciona un tipo de documento</option>
                @foreach($tiposDocumentos as $tipo)
                <option value="{{ $tipo->id }}" {{ old('id_tipo_documento') == $tipo->id ? 'selected' : '' }}>
                    {{ $tipo->descripcion }}
                </option>
                @endforeach
            </select>
            <label for="id_tipo_documento">Tipo de Documento</label>
            @error('id_tipo_documento')
            <div class="text-danger mt-1 px-2 py-1" style="background-color:#ffe6e6; border-radius:4px;">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-floating">
            <input type="text"
                class="form-control @error('documento_estudiante') is-invalid @enderror"
                id="documento_estudiante"
                name="documento_estudiante"
                required
                value="{{ old('documento_estudiante') }}"
                placeholder="Documento del Estudiante">
            <label for="documento_estudiante">Documento</label>
            @error('documento_estudiante')
            <div class="text-danger mt-1 px-2 py-1" style="background-color:#ffe6e6; border-radius:4px;">{{ $message }}</div>
            @enderror
        </div>
    </div>


    <div class="col-md-3">
        <div class="form-floating">
            <input type="text"
                class="form-control @error('primer_nombre_estudiante') is-invalid @enderror"
                id="primer_nombre_estudiante"
                name="primer_nombre_estudiante"
                required
                value="{{ old('primer_nombre_estudiante') }}"
                placeholder="Primer Nombre">
            <label for="primer_nombre_estudiante">Primer Nombre</label>
            @error('primer_nombre_estudiante')
            <div class="text-danger mt-1 px-2 py-1" style="background-color:#ffe6e6; border-radius:4px;">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-md-3">
        <div class="form-floating">
            <input type="text"
                class="form-control @error('segundo_nombre_estudiante') is-invalid @enderror"
                id="segundo_nombre_estudiante"
                name="segundo_nombre_estudiante"
                value="{{ old('segundo_nombre_estudiante') }}"
                placeholder="Segundo Nombre">
            <label for="segundo_nombre_estudiante">Segundo Nombre</label>
            @error('segundo_nombre_estudiante')
            <div class="text-danger mt-1 px-2 py-1" style="background-color:#ffe6e6; border-radius:4px;">{{ $message }}</div>
            @enderror
        </div>
    </div>
</div>

<div class="row mb-3">
    <div class="col-md-3">
        <div class="form-floating">
            <input type="text"
                class="form-control @error('primer_apellido_estudiante') is-invalid @enderror"
                id="primer_apellido_estudiante"
                name="primer_apellido_estudiante"
                required
                value="{{ old('primer_apellido_estudiante') }}"
                placeholder="Primer Apellido">
            <label for="primer_apellido_estudiante">Primer Apellido</label>
            @error('primer_apellido_estudiante')
            <div class="text-danger mt-1 px-2 py-1" style="background-color:#ffe6e6; border-radius:4px;">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-floating">
            <input type="text"
                class="form-control @error('segundo_apellido_estudiante') is-invalid @enderror"
                id="segundo_apellido_estudiante"
                name="segundo_apellido_estudiante"
                value="{{ old('segundo_apellido_estudiante') }}"
                placeholder="Segundo Apellido">
            <label for="segundo_apellido_estudiante">Segundo Apellido</label>
            @error('segundo_apellido_estudiante')
            <div class="text-danger mt-1 px-2 py-1" style="background-color:#ffe6e6; border-radius:4px;">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-md-3">
        <div class="form-floating">
            <input type="number"
                class="form-control @error('edad_estudiante') is-invalid @enderror"
                id="edad_estudiante"
                name="edad_estudiante"
                required
                value="{{ old('edad_estudiante') }}"
                placeholder="Edad">
            <label for="edad_estudiante">Edad</label>
            @error('edad_estudiante')
            <div class="text-danger mt-1 px-2 py-1" style="background-color:#ffe6e6; border-radius:4px;">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-md-3">
        <div class="form-floating">
            <input type="date"
                class="form-control @error('fecha_nacimiento_estudiante') is-invalid @enderror"
                id="fecha_nacimiento_estudiante"
                name="fecha_nacimiento_estudiante"
                required
                value="{{ old('fecha_nacimiento_estudiante') }}"
                placeholder="Fecha de nacimiento">
            <label for="fecha_nacimiento_estudiante">Fecha de nacimiento</label>
            @error('fecha_nacimiento_estudiante')
            <div class="text-danger mt-1 px-2 py-1" style="background-color:#ffe6e6; border-radius:4px;">{{ $message }}</div>
            @enderror
        </div>
    </div>
</div>

<div class="row mb-3">
    <div class="col-md-3">
        <div class="form-floating">
            <input type="text"
                class="form-control @error('celular_estudiante') is-invalid @enderror"
                id="celular_estudiante"
                name="celular_estudiante"
                value="{{ old('celular_estudiante') }}"
                placeholder="Celular">
            <label for="celular_estudiante">Celular</label>
            @error('celular_estudiante')
            <div class="text-danger mt-1 px-2 py-1" style="background-color:#ffe6e6; border-radius:4px;">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-floating">
            <input type="text"
                class="form-control @error('telefono_estudiante') is-invalid @enderror"
                id="telefono_estudiante"
                name="telefono_estudiante"
                value="{{ old('telefono_estudiante') }}"
                placeholder="Teléfono">
            <label for="telefono_estudiante">Teléfono</label>
            @error('telefono_estudiante')
            <div class="text-danger mt-1 px-2 py-1" style="background-color:#ffe6e6; border-radius:4px;">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-md-3">
        <div class="form-floating">
            <input type="email"
                class="form-control @error('correo_electronico_estudiante') is-invalid @enderror"
                id="correo_electronico_estudiante"
                name="correo_electronico_estudiante"
                value="{{ old('correo_electronico_estudiante') }}"
                placeholder="Correo Electrónico">
            <label for="correo_electronico_estudiante">Correo Electrónico</label>
            @error('correo_electronico_estudiante')
            <div class="text-danger mt-1 px-2 py-1" style="background-color:#ffe6e6; border-radius:4px;">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-md-3">
        <div class="form-floating">
            <input type="text"
                class="form-control @error('direccion_estudiante') is-invalid @enderror"
                id="direccion_estudiante"
                name="direccion_estudiante"
                value="{{ old('direccion_estudiante') }}"
                placeholder="Dirección">
            <label for="direccion_estudiante">Dirección</label>
            @error('direccion_estudiante')
            <div class="text-danger mt-1 px-2 py-1" style="background-color:#ffe6e6; border-radius:4px;">{{ $message }}</div>
            @enderror
        </div>
    </div>
</div>

<div class="row mb-3">
    <div class="col-md-3">
        <div class="form-floating mt-2">
            <select name="id_grado"
                class="form-select @error('id_grado') is-invalid @enderror"
                id="id_grado"
                required>
                <option value="" disabled {{ old('id_grado') ? '' : 'selected' }}>Selecciona un grado</option>
                @foreach($grados as $grado)
                <option value="{{ $grado->id }}" {{ old('id_grado') == $grado->id ? 'selected' : '' }}>
                    {{ $grado->nombre_grado }}
                </option>
                @endforeach
            </select>
            <label for="id_grado">Grado</label>
            @error('id_grado')
            <div class="text-danger mt-1 px-2 py-1" style="background-color:#ffe6e6; border-radius:4px;">{{ $message }}</div>
            @enderror
        </div>
    </div>
</div>

<div class="row mb-3">
    <div class="col-md-12 position-relative">
        <div class="form-floating">
            <input type="text"
                id="buscar_acudiente"
                name="buscar_acudiente"
                class="form-control @error('acudiente_id') is-invalid @enderror"
                placeholder="Buscar por nombre o documento"
                value="{{ old('buscar_acudiente') }}">
            <label for="buscar_acudiente">
                Buscar Acudiente
            </label>
        </div>

        @error('acudiente_id')
        <div class="text-danger mt-1 px-2 py-1" style="background-color:#ffe6e6; border-radius:4px;">
            {{ $message }}
        </div>
        @enderror

        {{-- Resultados dinámicos --}}
        <ul id="resultados_acudientes"
            class="list-group position-absolute shadow-lg rounded w-50 w-md-75 w-lg-50 bg-white"
            style="z-index: 1050; max-height: 250px; overflow-y: auto;">
        </ul>


        <input type="hidden" name="acudiente_id" id="acudiente_id" value="{{ old('acudiente_id') }}">
    </div>

</div>

@endsection

@section('botones-formulario')
<x-boton-principal href="{{ route('estudiantes.index') }}">
    <i class="fas fa-arrow-left"></i> Cancelar
</x-boton-principal>
<x-boton-principal type="submit">
    <i class="fas fa-save"></i> Guardar
</x-boton-principal>
@endsection