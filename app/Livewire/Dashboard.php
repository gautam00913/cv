<?php

namespace App\Livewire;

use Livewire\Component;

class Dashboard extends Component
{
    public function render()
    {
        $user = auth()->user()->load('profile');
        return view('livewire.dashboard', [
            'user' => $user,
            'profile' => $user->profile->loadCount(['experiences', 'competences', 'educations', 'portfolios']),
        ]);
    }
}
