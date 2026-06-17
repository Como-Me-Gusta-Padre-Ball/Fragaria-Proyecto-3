<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PerfumeFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => fake()->word(),
            'marca' => fake()->company(),
            'descripcion' => fake()->sentence(),
            'categoria_olfativa' => fake()->randomElement(['Cítrico', 'Amaderado', 'Dulce', 'Aromático']),
            'imagen_url' => fake()->imageUrl(),
        ];
    }
}
