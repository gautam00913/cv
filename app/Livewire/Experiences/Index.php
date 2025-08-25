<?php

namespace App\Livewire\Experiences;

use App\Models\Profile;
use Livewire\Component;
use Filament\Forms\Form;
use Filament\Forms\Components\Select;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\Repeater;
use Filament\Notifications\Notification;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Concerns\InteractsWithForms;

class Index extends Component implements HasForms
{
    use InteractsWithForms;
    public ?array $data = [];
    public Profile $profile;

    public function mount()
    {
        $this->profile = auth()->user()->load('profile.experiences')->profile;
        $this->form->fill([
            'experiences' => $this->profile->experiences->toArray(),
        ]);
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Repeater::make('experiences')
                    ->relationship('experiences')
                    ->schema([
                        Select::make('company_id')
                            ->label("Entreprise")
                            ->relationship('company', 'name')
                            ->preload()
                            ->searchable()
                            ->required(),
                        Select::make('job_title_id')
                            ->label("Poste")
                            ->relationship('jobTitle', 'name')
                            ->preload()
                            ->searchable()
                            ->required(),
                        Checkbox::make('current')
                            ->label('Actuellement en poste')
                            ->reactive(),
                        DatePicker::make('started_at')
                            ->label('Date de début')
                            ->required(),
                        DatePicker::make('finished_at')
                            ->label('Date de fin')
                            ->hidden(fn(callable $get) => (bool)$get('current'))
                            ->required(fn(callable $get) => !(bool)$get('current')),
                        RichEditor::make('description')
                            ->label('Description')
                            ->required(),
                    ])
                    ->addActionLabel('Ajouter une expérience')
                    ->orderColumn('sort')
                    ->collapsed()
                    ->label(''),
            ])
            ->statePath('data')
            ->model($this->profile);
    }

    public function submit()
    {
        $done = $this->profile->update($this->form->getState());
        if ($done)
            Notification::make()
                ->title("Expériences mises à jour avec succès.")
                ->success()
                ->send();
    }
    
    public function render()
    {
        return view('livewire.experiences.index');
    }
}