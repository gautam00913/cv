<?php

namespace App\Livewire\Educations;

use App\Models\Profile;
use Livewire\Component;

class Show extends Component
{
    public $showList;

    public function mount(Profile $profile)
    {
        $this->showList = $profile->load(['educations']);
    }

    public function render()
    {
        return view('livewire.educations.show');
    }
}
