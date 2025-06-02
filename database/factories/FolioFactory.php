<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Folio>
 */
class FolioFactory extends Factory
{
    public function definition(): array
    {
        return [
            'libro_id' => 1, // Ajusta según tus datos de prueba o usa un factory de Libro si lo necesitas
        ];
    }
}