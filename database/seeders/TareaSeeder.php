<?php

namespace Database\Seeders;

use App\Models\Tarea;
use App\Models\User;
use Illuminate\Database\Seeder;

class TareaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear algunos usuarios si no existen
        User::factory()->count(5)->create();

        // Obtener todos los usuarios existentes
        $users = User::all();

        // Crear algunas tareas y asignarlas a usuarios específicos
        Tarea::factory()->count(10)->create()->each(function ($tarea) use ($users) {
            $tarea->user_id = $users->random()->id;
            $tarea->save();
        });
    }
}