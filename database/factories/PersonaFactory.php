<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Persona>
 */
class PersonaFactory extends Factory
{
    public function definition(): array
    {
        // Elegir género aleatorio
        $sexo = $this->faker->randomElement(['M', 'F']);
        // Generar nombre según género
        $nombre = $sexo === 'M'
            ? $this->faker->firstNameMale()
            : $this->faker->firstNameFemale();


        return [
            'dni' => str_pad($this->faker->numberBetween(0, 99999999), 8, '0', STR_PAD_LEFT),
            'nombre' => $nombre,
            'apellido' => $this->faker->lastName(),
            'lugar_id' => 1, // Ajusta según tus datos de prueba
            'sexo' => $sexo,
            'fecha_nacimiento' => $this->faker->date('Y-m-d', now()->subYears(18)->toDateString()),
            'estado_civil' => 'S',
            'telefono' => $this->faker->numerify('9########'),
            'pertenece_pueblo' => 1,
        ];
    }
}

    