<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Rol;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Usuario>
 */
class UsuarioFactory extends Factory
{
    public function definition(): array
    {
        $rolDocente = Rol::where('nombre', 'Docente')->first();

        $documento = $this->faker->unique()->numerify('##########');

        return [
            'documento' => $documento,
            'celular' => $this->faker->numerify('3#########'),
            'nombres' => $this->faker->firstName(),
            'apellidos' => $this->faker->lastName(),
            'correo_electronico' => $this->faker->unique()->safeEmail(),
            'contrasena' => bcrypt($documento),
            'rol_id' => $rolDocente ? $rolDocente->id : 8, // usa el rol docente si existe
            'tipo_documento_id' => $this->faker->numberBetween(3, 7),
        ];
    }
}
