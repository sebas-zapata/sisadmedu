<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Usuario;
use App\Models\Rol;

class EstudianteFactory extends Factory
{
    public function definition(): array
    {
        // Rango de edades de ejemplo
        $edadMin = 6;
        $edadMax = 18;

        return [
            // Se creará automáticamente un usuario vinculado
            'usuario_id' => Usuario::factory()->state(function () use ($edadMin, $edadMax) {
                $rolEstudiante = Rol::where('nombre', 'Estudiante')->first();
                // Generar documento
                $documento = $this->faker->unique()->numerify('##########');
                return [
                    'documento' => $documento,
                    'celular' => $this->faker->numerify('3#########'),
                    'nombres' => $this->faker->firstName(),
                    'apellidos' => $this->faker->lastName(),
                    'correo_electronico' => $this->faker->unique()->safeEmail(),
                    'contrasena' => bcrypt($documento),
                    'rol_id' => $rolEstudiante ? $rolEstudiante->id : 16, // por defecto, id 9 si no existe
                    'tipo_documento_id' => $this->faker->numberBetween(3, 7),
                ];
            }),

            // Datos del estudiante
            'matricula' => $this->faker->unique()->numerify('MAT#######'),
            'primer_nombre_estudiante' => $this->faker->firstName(),
            'segundo_nombre_estudiante' => $this->faker->optional()->firstName(),
            'primer_apellido_estudiante' => $this->faker->lastName(),
            'segundo_apellido_estudiante' => $this->faker->optional()->lastName(),
            'edad_estudiante' => $edad = $this->faker->numberBetween($edadMin, $edadMax),
            'fecha_nacimiento_estudiante' => now()->subYears($edad)->format('Y-m-d'),
            'telefono_estudiante' => $this->faker->optional()->numerify('3#########'),
            'direccion_estudiante' => $this->faker->address(),
            'id_grado' => $this->faker->numberBetween(14, 15),
            'id_tipo_documento' => $this->faker->numberBetween(3, 7),
        ];
    }
}
