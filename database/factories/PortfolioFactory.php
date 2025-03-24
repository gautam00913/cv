<?php

namespace Database\Factories;

use App\Models\Profile;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Portfolio>
 */
class PortfolioFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(rand(2, 5)),
            'description' => $this->faker->paragraph(rand(2, 5)),
            'picture' => $this->faker->imageUrl(),
            'link' => $this->faker->url(),
            'profile_id' => Profile::factory(),
        ];
    }
}
