<?php

namespace App\Livewire\Portfolios;

use App\Models\Profile;
use Livewire\Component;

class Show extends Component
{
    public Profile $showList;

    public int $index = 0;

    public function mount(Profile $profile)
    {
        $this->showList = $profile->load(['portfolios']);
    }

    public function nextElement(): void
    {
        $count = $this->showList->portfolios->count();
        if ($count > 0) {
            $this->index = ($this->index + 1) % $count;
        }
    }

    public function previousElement(): void
    {
        $count = $this->showList->portfolios->count();
        if ($count > 0) {
            $this->index = ($this->index - 1 + $count) % $count;
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
