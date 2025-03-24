<?php

namespace App\Livewire\Portfolios;

use App\Models\Portfolio;
use App\Models\Profile;
use Livewire\Component;

class Show extends Component
{
    public $showList;
    public Portfolio $portfolio;
    
    public function mount(Profile $profile)
    {
        $this->showList = $profile->load(['portfolios']);
    }

    public function render()
    {
        return view('livewire.portfolios.show');
    }
}
