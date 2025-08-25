<?php

namespace App\Livewire\Portfolios;

use App\Models\Profile;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Livewire\Component;

class Index extends Component implements HasForms
{
    use InteractsWithForms;
    public ?array $data = [];
    public Profile $profile;

    public function mount()
    {
        $this->profile = auth()->user()->profile;
        $this->form->fill(['portfolios' => $this->profile->portfolios->toArray()]);
    }

    public function form(Form $form): Form
    {
        return $form->schema([
            Repeater::make('portfolios')
                ->relationship()
                ->schema([
                    TextInput::make('title')
                        ->label("Titre")
                        ->required(),
                    Textarea::make('description')
                        ->required()
                        ->maxLength(500),
                    FileUpload::make('picture')
                        ->label("Capture d'écran")
                        ->image()
                        ->required()
                        ->directory('images'),
                    TextInput::make('link')
                        ->label('Lien')
                        ->url()
                ])
                ->collapsible()
                ->addActionLabel("Ajouter un autre élément")
                ->label(""),
        ])
            ->statePath('data')
            ->model($this->profile);
    }

    public function submit()
    {
        $updated = $this->profile->update($this->form->getState());
        if ($updated)
            Notification::make()
                ->title("Modification effectuée avec succès")
                ->success()
                ->send();
    }

    public function render()
    {
        return view('livewire.portfolios.index');
    }
}