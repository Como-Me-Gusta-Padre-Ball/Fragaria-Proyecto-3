<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Perfume;

class ReseñaFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'perfume_id' => Perfume::factory(),
            'comentario' => fake()->sentence(),
            'calificacion' => fake()->numberBetween(1, 5),
            'duracion' => fake()->randomFloat(1, 4, 12),
            'proyeccion' => fake()->randomFloat(1, 1, 3),
            'fecha_publicacion' => now(),
        ];
    }
}
