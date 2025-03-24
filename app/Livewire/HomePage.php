<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;

class HomePage extends Component
{
    public string $component = 'competences.show';
    public string $active = 'competence';

    public function showComponent($component)
    {
        if($component != $this->active)
        {
            if(in_array($component, ['competence', 'experience', 'education', 'portfolio']))
            {
                $this->active = $component;
                $this->component = "{$component}s.show";
            }
        }
    }

    public function render()
    {
        $user = User::find(1)->load('profile');
        // $user = User::with([
        //                 'profile.experiences',
        //                 'profile.educations',
        //                 'profile.portfolios',
        //                 'profile.competences.competenceTitle',
        //                 'profile.competences.competenceSubTitle'
        //             ])
        //             ->find(1);
        //dd($user);
        return view('livewire.home-page')
                ->with('user', $user)
                ->layout('components.layouts.home');
    }
}
