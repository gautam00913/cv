<?php

namespace App\Livewire\Educations;

use App\Models\Education;
use App\Traits\TranslationTrait;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;

class Index extends Component implements HasForms
{
    use InteractsWithForms, TranslationTrait;

    public Education $education;

    public bool $editMode = false;

    public ?array $data = [];

    #[Computed(persist: true)]
    public function educations()
    {
        $user = auth()->user()->load('profile');

        return $user->profile->educations()->paginate(10);
    }

    public function mount()
    {
        $this->education = new Education;
        $this->form->fill();
    }

    public function edit(int $id)
    {
        $this->education = Education::findOrFail($id);
        $this->editMode = true;
        $this->form->fill([
            'grade' => $this->education->grade,
            'description' => $this->education->description,
            'year' => $this->education->year,
        ]);
    }

    #[On('delete-education')]
    public function destroy(int $id)
    {
        $this->education = Education::findOrFail($id);
        $done = $this->education->delete();
        if ($done) {
            $this->dispatch('close-delete-modal');
            Notification::make()
                ->title(__('messages.education_deleted'))
                ->success()
                ->send();
        }
        $this->refresh();
    }

    public function form(Form $form): Form
    {
        return $form->schema([
            TextInput::make('grade')
                ->label(__('messages.grade_obtained'))
                ->required(),
            RichEditor::make('description')
                ->maxLength(500)
                ->required(),
            TextInput::make('year')
                ->label(__('messages.year_obtained'))
                ->numeric()
                ->minValue(1)
                ->required(),
        ])
            ->statePath('data')
            ->model($this->education);
    }

    public function submit()
    {
        $data = $this->form->getState();

        // Convert translatable fields to arrays with translations
        $current = app()->getLocale();
        $inverse = $current === 'en' ? 'fr' : 'en';
        $data['grade'] = [
            $current => $data['grade'],
            $inverse => $this->translate($data['grade']),
        ];

        $data['description'] = [
            $current => $data['description'],
            $inverse => $this->translate($data['description']),
        ];

        if ($this->editMode) {
            $done = $this->education->update($data);
            if ($done) {
                Notification::make()
                    ->title(__('messages.education_modified'))
                    ->success()
                    ->send();
                $this->reset('editMode');
            }
        } else {
            $done = auth()->user()->profile->educations()->create($data);
            if ($done) {
                Notification::make()
                    ->title(__('messages.education_added'))
                    ->success()
                    ->send();
            }
        }
        $this->form->fill();
        $this->refresh();
    }

    public function render()
    {
        return view('livewire.educations.index');
    }

    private function refresh(): void
    {
        unset($this->educations);
    }
}