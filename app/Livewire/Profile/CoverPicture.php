<?php

namespace App\Livewire\Profile;

use Livewire\Component;
use Livewire\Attributes\Rule;
use Livewire\WithFileUploads;
use Filament\Notifications\Notification;

class CoverPicture extends Component
{
    use WithFileUploads;

    #[Rule('required|image')]
    public $cover_picture;

    public function update()
    {
        $this->validate();
        $path = $this->cover_picture->storeAs('images', $this->cover_picture->hashName(), 'public');
        $update = auth()->user()->profile()->update(['cover_picture' => $path]);
        if($update){
            Notification::make()
            ->title('Photo mise à jour avec succès')
            ->success()
            ->send();
            return $this->redirect(route('dashboard'), navigate: true);
        }
    }

    public function render()
    {
        return view('livewire.profile.cover-picture', [
            'profile' => auth()->user()->profile
        ]);
    }
}
