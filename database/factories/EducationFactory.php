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
            'grade' => $this->faker->catchPhrase(),
            'description' => $this->faker->paragraph(3),
            'year' => now()->subYears(rand(2, 5))->format('Y'),
            'profile_id' => Profile::factory(),
        ];
    }
}
