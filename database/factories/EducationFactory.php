<?php

namespace Database\Factories;

use App\Models\Profile;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Education>
 */
class EducationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'grade' => [
                'en' => $this->faker->catchPhrase(),
                'fr' => $this->faker->catchPhrase()
            ],
            'description' => [
                'en' => $this->faker->paragraph(rand(2, 5)),
                'fr' => $this->faker->paragraph(rand(2, 5))
            ],
            'year' => now()->subYears(rand(2, 5))->format('Y'),
            'profile_id' => Profile::factory(),
        ];
    }
}