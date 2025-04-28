<?php

namespace App\Livewire\Portfolios;

use App\Models\Portfolio;
use App\Models\Profile;
use Livewire\Component;

class Show extends Component
{
    public $showList;
    public Portfolio $portfolio;
    public int $index = 0;
    
    public function mount(Profile $profile)
    {
        $this->showList = $profile->load(['portfolios']);
        $this->index = 0;
        $this->showPortfolio();
    }

    public function caroussel()
    {
        $this->nextElement();
    }

    public function nextElement()
    {
        if($this->index < count($this->showList->portfolios) - 1)
            $this->index ++;
        else
            $this->index = 0;
        
        $this->showPortfolio();
    }
    
    public function previousElement()
    {
        if($this->index > 0)
            $this->index --;
        else
            $this->index = 0;
        
        $this->showPortfolio();
    }

    public function render()
    {
        return view('livewire.portfolios.show');
    }

    private function showPortfolio()
    {
        $this->portfolio = $this->showList->portfolios[$this->index] ?? null;
    }
}