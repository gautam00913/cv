<?php

namespace App\Livewire\Portfolios;

use App\Models\Profile;
use Livewire\Component;

class Show extends Component
{
    public Profile $showList;

    public int $index = 0;
    public int $listCount = 0;

    public function mount(Profile $profile)
    {
        $this->showList = $profile->load(['activePortfolios']);
        $this->listCount = $this->showList->activePortfolios->count();
    }

    public function nextElement(): void
    {
        if ($this->listCount > 0) {
            $this->index = ($this->index + 1) % $this->listCount;
        }
    }

    public function previousElement(): void
    {
        if ($this->listCount > 0) {
            $this->index = ($this->index - 1 + $this->listCount) % $this->listCount;
        }
    }

    public function goToElement(int $index): void
    {
        $this->index = $index;
    }

    public function render()
    {
        return view('livewire.portfolios.show');
    }
}