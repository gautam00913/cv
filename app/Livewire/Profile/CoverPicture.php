<?php

namespace App\Livewire\Profile;

use Livewire\Component;
use Livewire\Attributes\Rule;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Form;

class CoverPicture extends Component implements HasForms
{
    use InteractsWithForms;

    public ?array $data = [];

    public function mount()
    {
        $this->form->fill();
    }

    public function update()
    {
        $this->validate();
        $update = auth()->user()->profile()->update($this->form->getState());
        if($update){
            Notification::make()
            ->title('Photo mise à jour avec succès')
            ->success()
            ->send();
            return $this->redirect(route('dashboard'), navigate: true);
        }
    }

   public function form(Form $form) : Form
   {
        return $form->schema([
            FileUpload::make('cover_picture')
                ->label("Photo de couverture")
                ->required()
                ->image()
                ->directory('images')
        ])
        ->statePath('data');
   }

    public function render()
    {
        return view('livewire.profile.cover-picture', [
            'profile' => auth()->user()->profile
        ]);
    }
}
