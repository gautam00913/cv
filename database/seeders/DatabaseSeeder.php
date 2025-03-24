<?php

namespace Database\Seeders;

use App\Models\Competence;
use App\Models\User;
use App\Models\Profile;
use App\Models\Experience;
use App\Models\CompetenceTitle;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\CompetenceSubTitle;
use App\Models\Education;
use App\Models\Portfolio;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $user = User::factory()->create([
            'name' => 'Gautier Djossou',
            'email' => 'gautierdjossou@gmail.com',
        ]);
        $profile = Profile::factory()->create([
            'user_id' => $user->id
        ]);
        Experience::factory(5)->create([
            'profile_id' => $profile->id,
        ]);
        $sub_titles = CompetenceSubTitle::factory(3)->create();
        CompetenceTitle::factory(5)->create()->each(function($competenceTitle) use($profile, $sub_titles){
            Competence::factory(rand(3, 7))->create([
                'competence_title_id' => $competenceTitle->id,
                'competence_sub_title_id' => $sub_titles->random()->id,
                'profile_id' => $profile->id,
            ]);

        });
        Education::factory(3)->create([
            'profile_id' => $profile->id,
        ]);
        Portfolio::factory(5)->create([
            'profile_id' => $profile->id,
        ]);
    }
}
