<?php

namespace App\Livewire\Portfolios;

use App\Models\Profile;
use App\Traits\TranslationTrait;
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
    use InteractsWithForms, TranslationTrait;

    public ?array $data = [];

    public Profile $profile;

    public function mount()
    {
        $this->profile = auth()->user()->profile;
        $this->form->fill(['portfolios' => []]);
    }

    public function form(Form $form): Form
    {
        return $form->schema([
            Repeater::make('portfolios')
                ->relationship('portfolios')
                ->schema([
                    TextInput::make('title')
                        ->label(__('messages.title'))
                        ->required(),
                    Textarea::make('description')
                        ->required()
                        ->maxLength(500),
                    FileUpload::make('picture')
                        ->label(__('messages.screenshot'))
                        ->image()
                        ->required()
                        ->directory('images'),
                    TextInput::make('link')
                        ->label(__('messages.link'))
                        ->url(),
                ])
                ->mutateRelationshipDataBeforeFillUsing(function (array $data): array {
                    $current = app()->getLocale();
                    $data['title'] = $data['title'][$current] ?? '';
                    $data['description'] = $data['description'][$current] ?? '';
                    return $data;
                })
                ->mutateRelationshipDataBeforeSaveUsing(function (array $data): array {
                    $current = app()->getLocale();
                    $inverse = $current === 'en' ? 'fr' : 'en';
                    $data['title'] = [
                        $current => $data['title'],
                        $inverse => $this->translate($data['title']),
                    ];
                    $data['description'] = [
                        $current => $data['description'],
                        $inverse => $this->translate($data['description']),
                    ];
                    return $data;
                })
                ->collapsible()
                ->addActionLabel(__('messages.add_another_item'))
                ->label(''),
        ])
            ->statePath('data')
            ->model($this->profile);
    }

    public function submit()
    {
        $updated = $this->profile->update($this->form->getState());
        if ($updated) {
            Notification::make()
                ->title(__('messages.modification_done'))
                ->success()
                ->send();
        }
    }

    public function render()
    {
        return view('livewire.portfolios.index');
    }
}