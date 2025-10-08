@extends('layouts.form')

@section('titulo-formulario')
Editar Docente <i class="fas fa-chalkboard-teacher"></i>
@endsection

@section('id-form', 'formulario-docente')

@section('ruta-accion')
{{ route('docentes.update', $docente->id) }}
@endsection

@section('metodo')
@method('PUT')
@csrf
@endsection

@section('campos-formulario')
<div class="row mb-3">
    <!-- Tipo Documento -->
    <div class="col-12 col-sm-6 col-md-3 mb-3 mb-md-0">
        <div class="form-floating mt-2">
            <select
                name="id_tipo_documento"
                id="id_tipo_documento"
                class="form-select @error('id_tipo_documento') is-invalid @enderror"
                required>
                <option value="" disabled {{ old('id_tipo_documento', $docente->id_tipo_documento) ? '' : 'selected' }}>
                    Seleccione un tipo
                </option>
                @foreach($documentos as $tipoDocumento)
                <option value="{{ $tipoDocumento->id }}"
                    {{ old('id_tipo_documento', $docente->id_tipo_documento) == $tipoDocumento->id ? 'selected' : '' }}>
                    {{ $tipoDocumento->descripcion }}
                </option>
                @endforeach
            </select>
            <label for="id_tipo_documento">Tipo de Documento</label>
        </div>
        @error('id_tipo_documento')
        <div class="text-danger mt-1 px-2 py-1" style="background-color:#ffe6e6; border-radius:4px;">{{ $message }}</div>
        @enderror
    </div>

    <!-- Documento -->
    <div class="col-12 col-sm-6 col-md-3 mb-3 mb-md-0">
        <div class="form-floating">
            <input
                type="text"
                name="documento"
                id="documento"
                class="form-control @error('documento') is-invalid @enderror"
                value="{{ old('documento', $docente->usuario->documento) }}"
                placeholder=" "
                required>
            <label for="documento">Documento</label>
        </div>
        @error('documento')
        <div class="text-danger mt-1 px-2 py-1" style="background-color:#ffe6e6; border-radius:4px;">{{ $message }}</div>
        @enderror
    </div>

    <!-- Primer Nombre -->
    <div class="col-12 col-sm-6 col-md-3 mb-3 mb-md-0">
        <div class="form-floating">
            <input
                type="text"
                name="primer_nombre"
                id="primer_nombre"
                class="form-control @error('primer_nombre') is-invalid @enderror"
                value="{{ old('primer_nombre', $docente->primer_nombre) }}"
                placeholder=" "
                required>
            <label for="primer_nombre">Primer Nombre</label>
        </div>
        @error('primer_nombre')
        <div class="text-danger mt-1 px-2 py-1" style="background-color:#ffe6e6; border-radius:4px;">{{ $message }}</div>
        @enderror
    </div>

    <!-- Segundo Nombre -->
    <div class="col-12 col-sm-6 col-md-3 mb-3 mb-md-0">
        <div class="form-floating">
            <input
                type="text"
                name="segundo_nombre"
                id="segundo_nombre"
                class="form-control @error('segundo_nombre') is-invalid @enderror"
                value="{{ old('segundo_nombre', $docente->segundo_nombre) }}"
                placeholder=" ">
            <label for="segundo_nombre">Segundo Nombre</label>
        </div>
        @error('segundo_nombre')
        <div class="text-danger mt-1 px-2 py-1" style="background-color:#ffe6e6; border-radius:4px;">{{ $message }}</div>
        @enderror
    </div>
</div>

<div class="row mb-3">
    <!-- Primer Apellido -->
    <div class="col-12 col-sm-6 col-md-3 mb-3 mb-md-0">
        <div class="form-floating">
            <input
                type="text"
                name="primer_apellido"
                id="primer_apellido"
                class="form-control @error('primer_apellido') is-invalid @enderror"
                value="{{ old('primer_apellido', $docente->primer_apellido) }}"
                placeholder=" "
                required>
            <label for="primer_apellido">Primer Apellido</label>
        </div>
        @error('primer_apellido')
        <div class="text-danger mt-1 px-2 py-1" style="background-color:#ffe6e6; border-radius:4px;">{{ $message }}</div>
        @enderror
    </div>

    <!-- Segundo Apellido -->
    <div class="col-12 col-sm-6 col-md-3 mb-3 mb-md-0">
        <div class="form-floating">
            <input
                type="text"
                name="segundo_apellido"
                id="segundo_apellido"
                class="form-control @error('segundo_apellido') is-invalid @enderror"
                value="{{ old('segundo_apellido', $docente->segundo_apellido) }}"
                placeholder=" ">
            <label for="segundo_apellido">Segundo Apellido</label>
        </div>
        @error('segundo_apellido')
        <div class="text-danger mt-1 px-2 py-1" style="background-color:#ffe6e6; border-radius:4px;">{{ $message }}</div>
        @enderror
    </div>

    <!-- Correo -->
    <div class="col-12 col-sm-6 col-md-3 mb-3 mb-md-0">
        <div class="form-floating">
            <input
                type="email"
                name="correo_electronico"
                id="correo_electronico"
                class="form-control @error('correo_electronico') is-invalid @enderror"
                value="{{ old('correo_electronico', $docente->usuario->correo_electronico) }}"
                placeholder=" "
                required>
            <label for="correo_electronico">Correo Electrónico</label>
        </div>
        @error('correo_electronico')
        <div class="text-danger mt-1 px-2 py-1" style="background-color:#ffe6e6; border-radius:4px;">{{ $message }}</div>
        @enderror
    </div>

    <!-- Celular -->
    <div class="col-12 col-sm-6 col-md-3 mb-3 mb-md-0">
        <div class="form-floating">
            <input
                type="text"
                name="celular"
                id="celular"
                class="form-control @error('celular') is-invalid @enderror"
                value="{{ old('celular', $docente->usuario->celular) }}"
                placeholder=" "
                required>
            <label for="celular">Celular</label>
        </div>
        @error('celular')
        <div class="text-danger mt-1 px-2 py-1" style="background-color:#ffe6e6; border-radius:4px;">{{ $message }}</div>
        @enderror
    </div>
</div>

<div class="row mb-3">
    <!-- Fecha Nacimiento -->
    <div class="col-12 col-sm-6 col-md-3 mb-3 mb-md-0">
        <div class="form-floating">
            <input
                type="date"
                name="fecha_nacimiento"
                id="fecha_nacimiento"
                class="form-control @error('fecha_nacimiento') is-invalid @enderror"
                value="{{ old('fecha_nacimiento', $docente->fecha_nacimiento) }}"
                placeholder=" ">
            <label for="fecha_nacimiento">Fecha de Nacimiento</label>
        </div>
        @error('fecha_nacimiento')
        <div class="text-danger mt-1 px-2 py-1" style="background-color:#ffe6e6; border-radius:4px;">{{ $message }}</div>
        @enderror
    </div>

    <!-- Dirección -->
    <div class="col-12 col-sm-6 col-md-3 mb-3 mb-md-0">
        <div class="form-floating">
            <input
                type="text"
                name="direccion"
                id="direccion"
                class="form-control @error('direccion') is-invalid @enderror"
                value="{{ old('direccion', $docente->direccion) }}"
                placeholder=" ">
            <label for="direccion">Dirección</label>
        </div>
        @error('direccion')
        <div class="text-danger mt-1 px-2 py-1" style="background-color:#ffe6e6; border-radius:4px;">{{ $message }}</div>
        @enderror
    </div>

    <!-- Especialización -->
    <div class="col-12 col-sm-6 col-md-3 mb-3 mb-md-0">
        <div class="form-floating">
            <input
                type="text"
                name="especializacion"
                id="especializacion"
                class="form-control @error('especializacion') is-invalid @enderror"
                value="{{ old('especializacion', $docente->especializacion) }}"
                placeholder=" ">
            <label for="especializacion">Especialización</label>
        </div>
        @error('especializacion')
        <div class="text-danger mt-1 px-2 py-1" style="background-color:#ffe6e6; border-radius:4px;">{{ $message }}</div>
        @enderror
    </div>

    <!-- Años de Experiencia -->
    <div class="col-12 col-sm-6 col-md-3 mb-3 mb-md-0">
        <div class="form-floating">
            <input
                type="number"
                name="anios_experiencia"
                id="anios_experiencia"
                class="form-control @error('anios_experiencia') is-invalid @enderror"
                value="{{ old('anios_experiencia', $docente->anios_experiencia) }}"
                placeholder=" "
                min="0">
            <label for="anios_experiencia">Años de Experiencia</label>
        </div>
        @error('anios_experiencia')
        <div class="text-danger mt-1 px-2 py-1" style="background-color:#ffe6e6; border-radius:4px;">{{ $message }}</div>
        @enderror
    </div>
</div>

<div class="row mb-3">
    <!-- Fecha Ingreso -->
    <div class="col-12 col-sm-6 col-md-3 mb-3 mb-md-0">
        <div class="form-floating">
            <input
                type="date"
                name="fecha_ingreso"
                id="fecha_ingreso"
                class="form-control @error('fecha_ingreso') is-invalid @enderror"
                value="{{ old('fecha_ingreso', $docente->fecha_ingreso) }}"
                placeholder=" ">
            <label for="fecha_ingreso">Fecha de Ingreso</label>
        </div>
        @error('fecha_ingreso')
        <div class="text-danger mt-1 px-2 py-1" style="background-color:#ffe6e6; border-radius:4px;">{{ $message }}</div>
        @enderror
    </div>

    <!-- Estado Civil -->
    <div class="col-12 col-sm-6 col-md-3 mb-3 mb-md-0">
        <div class="form-floating mt-2">
            <select
                name="estado_civil"
                id="estado_civil"
                class="form-select @error('estado_civil') is-invalid @enderror">
                <option value="">Seleccione...</option>
                <option value="Soltero" {{ old('estado_civil', $docente->estado_civil) == 'Soltero' ? 'selected' : '' }}>Soltero</option>
                <option value="Casado" {{ old('estado_civil', $docente->estado_civil) == 'Casado' ? 'selected' : '' }}>Casado</option>
                <option value="Divorciado" {{ old('estado_civil', $docente->estado_civil) == 'Divorciado' ? 'selected' : '' }}>Divorciado</option>
                <option value="Viudo" {{ old('estado_civil', $docente->estado_civil) == 'Viudo' ? 'selected' : '' }}>Viudo</option>
            </select>
            <label for="estado_civil">Estado Civil</label>
        </div>
        @error('estado_civil')
        <div class="text-danger mt-1 px-2 py-1" style="background-color:#ffe6e6; border-radius:4px;">{{ $message }}</div>
        @enderror
    </div>

    <!-- Teléfono -->
    <div class="col-12 col-sm-6 col-md-3 mb-3 mb-md-0">
        <div class="form-floating">
            <input
                type="text"
                name="telefono"
                id="telefono"
                class="form-control @error('telefono') is-invalid @enderror"
                value="{{ old('telefono', $docente->telefono) }}"
                placeholder=" ">
            <label for="telefono">Teléfono</label>
        </div>
        @error('telefono')
        <div class="text-danger mt-1 px-2 py-1" style="background-color:#ffe6e6; border-radius:4px;">{{ $message }}</div>
        @enderror
    </div>

    <!-- Tipo de Contrato -->

    <div class="col-12 col-sm-6 col-md-3 mb-3 mb-md-0">
        <div class="form-floating mt-2">
            <select
                name="tipo_contrato"
                id="tipo_contrato"
                class="form-select @error('tipo_contrato') is-invalid @enderror">
                <option value="">Seleccione...</option>
                <option value="Planta" {{ old('tipo_contrato', $docente->tipo_contrato) == 'Planta' ? 'selected' : '' }}>Planta</option>
                <option value="Catedrático" {{ old('tipo_contrato', $docente->tipo_contrato) == 'Catedrático' ? 'selected' : '' }}>Catedrático</option>
                <option value="Temporal" {{ old('tipo_contrato', $docente->tipo_contrato) == 'Temporal' ? 'selected' : '' }}>Temporal</option>
            </select>
            <label for="tipo_contrato">Tipo de Contrato</label>
        </div>
        @error('tipo_contrato')
        <div class="text-danger mt-1 px-2 py-1" style="background-color:#ffe6e6; border-radius:4px;">{{ $message }}</div>
        @enderror
    </div>
</div>
@endsection


@section('botones-formulario')
<x-boton-principal href="{{ route('docentes.index') }}">
    <i class="fas fa-arrow-left"></i> Cancelar
</x-boton-principal>
<x-boton-principal type="submit">
    <i class="fas fa-save"></i> Guardar
</x-boton-principal>
@endsection