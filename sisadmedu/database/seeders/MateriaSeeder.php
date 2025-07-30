<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Materia;

class MateriaSeeder extends Seeder
{

    // Enviará datos iniciales a la tabla 'materias'
    // Este seeder crea varias materias con descripciones predefinidas
    // Esto es útil para tener datos consistentes en la base de datos
    // y para facilitar el desarrollo y las pruebas de la aplicación.
    // Puedes agregar más materias aquí si es necesario.
    // Por ejemplo, si tienes más materias que deseas incluir en la base de datos,
    // simplemente añádelas al array $materias.
    // Esto asegura que cada vez que se ejecute el seeder, las materias
    // estarán disponibles en la base de datos para su uso en la aplicación.
    public function run(): void
    {
    $materias = [
        'Matemáticas',
        'Ciencias Naturales',
        'Lengua Castellana',
        'Inglés',
        'Educación Física',
        'Religión',
        'Tecnología e Informática',
    ];

    // Itera sobre el array de materias y las crea en la base de datos
    // Utiliza el modelo Materia para insertar cada materia con su descripción
    // Esto asegura que cada materia tenga una descripción única y se almacene correctamente
    // en la tabla 'materias'.
    foreach ($materias as $materia) {
        Materia::create(['descripcion' => $materia]);
    }
    }
}
