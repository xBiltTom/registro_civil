<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ActaFactory extends Factory
{
    public function definition(): array
    {
        return [
            'fecha_registro' => $this->faker->date(),
            'persona_id' => 1, // Ajusta según tus datos de prueba
            'folio_id' => 1,   // Ajusta según tus datos de prueba
            'user_id' => 1,    // Ajusta según tus datos de prueba
            'ruta_pdf' => $this->faker->lexify('documento_????.pdf'),
        ];
    }
}