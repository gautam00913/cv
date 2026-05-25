<?php

namespace App\Livewire\Profile;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Livewire\Component;

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
        if ($update) {
            Notification::make()
                ->title(__('messages.cover_photo_updated'))
                ->success()
                ->send();

            return $this->redirect(route('dashboard'), navigate: true);
        }
    }

    public function form(Form $form): Form
    {
        return $form->schema([
            FileUpload::make('cover_picture')
                ->label(__('messages.cover_photo'))
                ->required()
                ->image()
                ->directory('images'),
        ])
            ->statePath('data');
    }

    public function render()
    {
        return view('livewire.profile.cover-picture', [
            'profile' => auth()->user()->profile,
        ]);
    }
}
