<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Ejecutar el seeder de usuarios (si no se han creado usuarios)
        if (User::count() === 0) {
            User::factory()->create([
                'name' => 'Test User',
                'email' => 'test@example.com',
                'password' => bcrypt('password'), // Asegúrate de tener un password
            ]);
            User::factory()->count(4)->create(); // Crear algunos usuarios más de prueba
        }

        // Ejecutar el seeder de tareas
        $this->call([
            TareaSeeder::class,
        ]);
    }
}