<?php

namespace Database\Factories;

use App\Models\Tarea;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tarea>
 */
class TareaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Tarea::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'titulo' => $this->faker->sentence(),
            'descripcion' => $this->faker->paragraph(),
            'fecha_vencimiento' => $this->faker->dateTimeBetween('now', '+1 month'),
            'user_id' => User::factory(), // Asocia la tarea a un usuario aleatorio
        ];
    }
}