<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Usuario;
use App\Models\Rol;

class AcudienteFactory extends Factory
{
    public function definition(): array
    {
        // Se crea automáticamente un usuario con rol Acudiente
        return [
            'usuario_id' => Usuario::factory()->state(function () {
                $rolAcudiente = Rol::where('nombre', 'Acudiente')->first();
                $documento = $this->faker->unique()->numerify('##########');

                return [
                    'documento' => $documento,
                    'nombres' => $this->faker->firstName() . ' ' . $this->faker->firstName(),
                    'apellidos' => $this->faker->lastName() . ' ' . $this->faker->lastName(),
                    'correo_electronico' => $this->faker->unique()->safeEmail(),
                    'celular' => $this->faker->numerify('3#########'),
                    'contrasena' => bcrypt($documento),
                    'reset_code' => null,
                    'reset_code_expires_at' => null,
                    'rol_id' => $rolAcudiente ? $rolAcudiente->id : 14,
                    'tipo_documento_id' => $this->faker->numberBetween(3, 7),
                ];
            }),

            // Datos específicos del acudiente si los hubiera
            // Por ahora dejamos solo campos básicos, puedes agregar más según tu tabla
        ];
    }
}
