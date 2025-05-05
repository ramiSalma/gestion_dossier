<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\dossier>
 */
class DossierFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'num' => $this->faker->numberBetween(0,1000),
            'code' => $this->faker->numerify('####'),
            'annee' => $this->faker->year(),
            'date_archivage' => null, 
        ];
    }
}
