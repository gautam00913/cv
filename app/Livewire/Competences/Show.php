<?php

namespace App\Livewire\Competences;

use App\Models\Profile;
use Livewire\Component;

class Show extends Component
{
    public $showList;

    public function mount(Profile $profile)
    {
        $this->showList = $profile->load(['competences.competenceTitle', 'competences.competenceSubTitle']);
    }

    public function render()
    {
        return view('livewire.competences.show');
    }
}
