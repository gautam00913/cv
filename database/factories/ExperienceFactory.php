<?php

namespace Database\Factories;

use App\Models\Company;
use App\Models\JobTitle;
use App\Models\Profile;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Experience>
 */
class ExperienceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'description' => $this->faker->paragraphs(4, true),
            'current' => $current = $this->faker->boolean(20),
            'started_at' => now()->subMonths(
                $this->faker->numberBetween(3, 12)
            ),
            'finished_at' => $current ? null : now()->addMonths(
                $this->faker->numberBetween(3, 12)
            ),
            'job_title_id' => JobTitle::factory(),
            'company_id' => Company::factory(),
            'profile_id' => Profile::factory(),
        ];
    }
}
