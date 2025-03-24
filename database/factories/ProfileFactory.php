<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Profile>
 */
class ProfileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'biography' => $this->faker->paragraphs(rand(2, 4), true),
            'picture' => $this->faker->imageUrl(),
            'cover_picture' => $this->faker->image(),
            'user_id' => User::factory()
        ];
    }
}
