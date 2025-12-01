@extends('layouts.show')

@section('titulo', 'Mi Información')

@section('informacion')
<div class="container py-4">
    <div class="card shadow-lg border-0 rounded-4 overflow-hidden">

        {{-- Encabezado --}}
        <div class="card-header text-white d-flex align-items-center justify-content-between"
             style="background-color: #461c68;">
            <div>
                <i class="fa-solid fa-user fa-lg me-2"></i>
                <span class="fw-bold fs-5">Mi Información</span>
            </div>

            <a href="{{ route('dashboard') }}" class="btn btn-secondary btn-sm">
                <i class="fa-solid fa-arrow-left me-1"></i> Volver
            </a>
        </div>

        {{-- Avatar --}}
        <div class="text-center py-4 bg-light">
            <img src="{{ Avatar::create($usuario->nombres . ' ' . $usuario->apellidos)->toBase64() }}"
                 alt="Avatar de {{ $usuario->nombres }}"
                 class="rounded-circle shadow-sm border border-3"
                 style="border-color: #461c68;"
                 width="110"
                 height="110">

            <h4 class="mt-3 mb-0 fw-bold text-dark">
                {{ $usuario->nombres }} {{ $usuario->apellidos }}
            </h4>

            <span class="badge mt-2 px-3 py-2 fs-6 text-white"
                  style="background-color: #461c68;">
                Rol: {{ $usuario->rol->nombre }}
            </span>
        </div>

        {{-- Contenido con Tabs --}}
        <div class="card-body bg-light">
            <ul class="nav nav-tabs border-0 mb-4" id="usuarioTabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active fw-bold text-dark"
                            id="info-tab"
                            data-bs-toggle="tab"
                            data-bs-target="#info"
                            type="button"
                            role="tab"
                            aria-controls="info"
                            aria-selected="true">
                        <i style="color: #461c68;" class="fa-solid fa-id-card me-2"></i>
                        Información General
                    </button>
                </li>
            </ul>

            <div class="tab-content" id="usuarioTabsContent">

                {{-- TAB 1: Información General --}}
                <div class="tab-pane fade show active" id="info" role="tabpanel" aria-labelledby="info-tab">
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-header fw-bold text-white" style="background-color: #461c68;">
                            <i class="fa-solid fa-id-card me-2"></i>
                            Datos Personales
                        </div>

                        <div class="card-body bg-white">
                            <div class="row">

                                <div class="col-md-6 mb-2">
                                    <strong>Identificador:</strong> #{{ $usuario->id }}
                                </div>

                                <div class="col-md-6 mb-2">
                                    <strong>Documento:</strong> {{ $usuario->documento }}
                                </div>

                                <div class="col-md-6 mb-2">
                                    <strong>Correo electrónico:</strong> {{ $usuario->correo_electronico }}
                                </div>

                                <div class="col-md-6 mb-2">
                                    <strong>Celular:</strong> {{ $usuario->celular }}
                                </div>

                                <div class="col-md-6 mb-2">
                                    <strong>Tipo de documento:</strong>
                                    {{ $usuario->tipoDocumento->descripcion ?? 'Sin tipo' }}
                                </div>

                                <div class="col-md-6 mb-2">
                                    <strong>Rol:</strong> {{ $usuario->rol->nombre }}
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

            </div> {{-- Fin de Tab Content --}}
        </div>
    </div>
</div>
@endsection
