<?php

namespace App\Livewire\Experiences;

use Carbon\Carbon;
use App\Models\Profile;
use Livewire\Component;
use App\Models\Experience;

class Show extends Component
{
    public Profile $profile;
    
    public function mount(Profile $profile)
    {
        $this->profile = $profile;
        Carbon::setLocale(app()->getLocale());
    }

    public function render()
    {
        return view('livewire.experiences.show', [
            'experiences' => Experience::with(['company', 'jobTitle'])
                                ->where('profile_id', $this->profile->id)
                                ->orderBy('sort')
                                ->get()
                            ,
        ]);
    }
}