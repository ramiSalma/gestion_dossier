<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\partie>
 */
class PartieFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $arabicNames = ['أحمد بن صالح', 'خديجة المريني', 'يوسف العلوي', 'سعاد الزهراء', 'عبد الله حجي', 'جميلة الإدريسي'];

        return [
            'full_name' => $this->faker->randomElement($arabicNames),
            'type' => $this->faker->randomElement(['متهم', 'ضحية']),
        ];
    }
}
