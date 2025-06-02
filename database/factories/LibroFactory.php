<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Libro>
 */
class LibroFactory extends Factory
{
    public function definition(): array
    {
        return [
            // Agrega aquí los campos que vayas a usar en la tabla libros
            // Por ejemplo:
            // 'titulo' => $this->faker->sentence(3),
            // 'autor' => $this->faker->name(),
        ];
    }
}