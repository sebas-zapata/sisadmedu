<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Collection;

class AsignacionService
{
    protected $api;

    public function __construct()
    {
        // URL base del microservicio Spring Boot
        $this->api = config('services.springboot.api_url');
    }

    /** Obtener todas las asignaciones */
    public function listar(): Collection
    {
        $response = Http::get($this->api);

        if ($response->failed()) {
            return collect([]);
        }

        return collect($response->json());
    }

    /** Crear una asignación */
    public function crear(array $data)
    {
        return Http::post($this->api, $data)->json();
    }

    /** Obtener una asignación por ID */
    public function obtener($id)
    {
        return Http::get("$this->api/$id")->json();
    }

    /** Actualizar asignación */
    public function actualizar($id, array $data)
    {
        return Http::put("$this->api/$id", $data)->json();
    }

    /** Eliminar asignación */
    public function eliminar($id)
    {
        return Http::delete("$this->api/$id")->successful();
    }
}
