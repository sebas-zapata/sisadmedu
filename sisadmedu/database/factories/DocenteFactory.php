<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Usuario;
use App\Models\Rol;

class DocenteFactory extends Factory
{
    public function definition(): array
    {
        $especializaciones = [
            'Matemáticas', 'Lengua Castellana', 'Ciencias Naturales',
            'Educación Física', 'Inglés', 'Tecnología', 'Informática',
            'Historia', 'Arte', 'Música',
        ];

        $tiposContrato = ['Planta', 'Catedrático', 'Temporal'];
        $estadosCiviles = ['Soltero', 'Casado', 'Divorciado', 'Viudo'];

        return [
            // Se creará automáticamente un usuario vinculado
            'usuario_id' => Usuario::factory()->state(function () {
                $rolDocente = Rol::where('nombre', 'Docente')->first();
                return [
                    'documento' => $this->faker->unique()->numerify('##########'),
                    'celular' => $this->faker->numerify('3#########'),
                    'nombres' => $this->faker->firstName(),
                    'apellidos' => $this->faker->lastName(),
                    'correo_electronico' => $this->faker->unique()->safeEmail(),
                    'contrasena' => bcrypt('password'),
                    'rol_id' => $rolDocente ? $rolDocente->id : 8,
                    'tipo_documento_id' => $this->faker->numberBetween(3, 7),
                ];
            }),

            // Datos del docente
            'primer_nombre' => $this->faker->firstName(),
            'segundo_nombre' => $this->faker->optional()->firstName(),
            'primer_apellido' => $this->faker->lastName(),
            'segundo_apellido' => $this->faker->optional()->lastName(),
            'fecha_nacimiento' => $this->faker->date('Y-m-d', '1990-01-01'),
            'telefono' => $this->faker->numerify('3#########'),
            'direccion' => $this->faker->address(),
            'estado_civil' => $this->faker->randomElement($estadosCiviles),
            'especializacion' => $this->faker->randomElement($especializaciones),
            'anios_experiencia' => $this->faker->numberBetween(1, 25),
            'fecha_ingreso' => $this->faker->dateTimeBetween('-10 years', 'now')->format('Y-m-d'),
            'tipo_contrato' => $this->faker->randomElement($tiposContrato),
            'id_tipo_documento' => $this->faker->numberBetween(3, 7),
        ];
    }
}
