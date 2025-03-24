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
use Livewire\Component;

class Index extends Component implements HasForms
{
    use InteractsWithForms;
    public ?array $data = [];

    public function mount()
    {
        $this->form->fill(['portfolios' => auth()->user()->profile->portfolios->toArray()]);
    }

    public function form(Form $form) : Form 
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
                TextInput::make('link')
                        ->label('Lien')
                        ->url(),
                FileUpload::make('picture')
                        ->label("Capture d'écran")
                        ->image()
                        ->directory('images')
            ])
            ->collapsible()
        ])
        ->statePath('data')
        ->model(Profile::class);
    }
    public function render()
    {
        return view('livewire.portfolios.index');
    }
}
