<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Lugar>
 */
class LugarFactory extends Factory
{
    public function definition(): array
    {
        return [
            'distrito' => 'Chicama',
            'provincia' => 'Ascope',
            'departamento' => 'La Libertad',
            'pais' => 'Perú',
        ];
    }
}