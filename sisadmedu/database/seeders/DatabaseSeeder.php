<?php

namespace Database\Seeders;


// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;



class DatabaseSeeder extends Seeder
{

    // Registrar los seeders que se ejecutarán al correr el comando `db:seed`
    // En este caso, solo se registra el MateriaSeeder
    // Esto permite poblar la tabla 'materias' con datos iniciales
    // que son necesarios para el funcionamiento de la aplicación.
    // Puedes agregar más seeders aquí si es necesario.
    // Por ejemplo, si tienes un seeder para usuarios o roles, lo puedes agregar aquí
    // para que se ejecute automáticamente al correr el comando `db:seed`.
    // Esto es útil para mantener la base de datos con datos consistentes
    // y para facilitar el desarrollo y las pruebas.
    public function run(): void
    {
        $this->call([
            MateriaSeeder::class,
            UsuarioSeeder::class, // Asegúrate de que este seeder exista
            DocenteSeeder::class, // Asegúrate de que este seeder exista
            NuevoUsuarioSeeder::class,
            OtroUsuarioSeeder::class,
            TipoDocumentoSeeder::class,
            EstudianteSeeder::class, // Asegúrate de que este seeder exista
            RolSeeder::class, // Asegúrate de que este seeder exista
            AdminUserSeeder::class, // Asegúrate de que este seeder exista
            DescansoSeeder::class
        ]);
    }
}
