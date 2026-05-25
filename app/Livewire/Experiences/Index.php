<?php

namespace App\Livewire\Experiences;

use App\Models\Profile;
use App\Traits\TranslationTrait;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
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
        $this->profile = auth()->user()->load('profile.experiences')->profile;
        $this->form->fill([
            'experiences' => [],
        ]);
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Repeater::make('experiences')
                    ->relationship('experiences')
                    ->schema([
                        Hidden::make('sort'),
                        Select::make('company_id')
                            ->label(__('messages.company'))
                            ->relationship('company', 'name')
                            ->preload()
                            ->searchable()
                            ->required(),
                        Select::make('job_title_id')
                            ->label(__('messages.position'))
                            ->relationship('jobTitle', 'name')
                            ->preload()
                            ->searchable()
                            ->required(),
                        Checkbox::make('current')
                            ->label(__('messages.currently_employed'))
                            ->reactive(),
                        DatePicker::make('started_at')
                            ->label(__('messages.start_date'))
                            ->required(),
                        DatePicker::make('finished_at')
                            ->label(__('messages.end_date'))
                            ->hidden(fn (callable $get) => (bool) $get('current'))
                            ->required(fn (callable $get) => ! (bool) $get('current')),
                        RichEditor::make('description')
                            ->label(__('messages.description'))
                            ->required(),
                    ])
                    ->mutateRelationshipDataBeforeFillUsing(function (array $data): array {
                        $data['description'] = $data['description'][app()->getLocale()] ?? '';
                        return $data;
                    })
                    ->mutateRelationshipDataBeforeCreateUsing(function (array $data): array {
                        $current = app()->getLocale();
                        $inverse = $current === 'en' ? 'fr' : 'en';
                        $data['description'] = [
                            $current => $data['description'],
                            $inverse => $this->translate($data['description']),
                        ];
                        return $data;
                    })
                    ->mutateRelationshipDataBeforeSaveUsing(function (array $data): array {
                        $current = app()->getLocale();
                        $inverse = $current === 'en' ? 'fr' : 'en';
                        $data['description'] = [
                            $current => $data['description'],
                            $inverse => $this->translate($data['description']),
                        ];
                        return $data;
                    })
                    ->addActionLabel(__('messages.add_experience'))
                    ->orderColumn('sort')
                    ->reorderableWithButtons()
                    ->collapsed()
                    ->itemLabel(fn (array $state): ?string => $state['sort'] ?? null)
                    ->label(''),
            ])
            ->statePath('data')
            ->model($this->profile);
    }

    public function submit()
    {
        $done = $this->profile->update($this->form->getState());
        if ($done) {
            Notification::make()
                ->title(__('messages.experiences_updated'))
                ->success()
                ->send();
        }
    }

    public function render()
    {
        return view('livewire.experiences.index');
    }
}