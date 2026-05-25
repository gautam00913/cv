<?php

namespace App\Livewire\Pages;

use App\Models\JobTitle;
use App\Traits\TranslationTrait;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class Position extends Component implements HasForms
{
    use InteractsWithForms, WithPagination, TranslationTrait;

    public ?array $data = [];

    public bool $editMode = false;

    public ?JobTitle $jobTitle = null;

    public function mount()
    {
        $this->form->fill();
    }

    public function form(Form $form): Form
    {
        return $form->schema([
            TextInput::make('name')->label(__('messages.name'))->required(),
        ])
            ->statePath('data');
    }

    public function editPosition(JobTitle $jobTitle)
    {
        $this->editMode = true;
        $this->jobTitle = $jobTitle;
        $this->form->fill(['name' => $jobTitle->name]);
        $this->dispatch('scroll-to-form', ['formId' => 'formulaire']);
    }

    #[On('delete-position')]
    public function deletePosition(int $id)
    {
        $jobTitle = JobTitle::find($id);
        if ($jobTitle) {
            $jobTitle->delete();
            Notification::make()
                ->title(__('messages.position_deleted'))
                ->success()
                ->send();

            return $this->dispatch('close-delete-modal');
        }
    }

    public function submit()
    {
        $data = $this->form->getState();
        $current = app()->getLocale();
        $inverse = $current === 'en' ? 'fr' : 'en';
        $data['name'] = [
            $current => $data['name'],
            $inverse => $this->translate($data['name']),
        ];
        
        if ($this->editMode && $this->jobTitle) {
            $done = $this->jobTitle->update($data);
            if ($done) {
                Notification::make()
                    ->title(__('messages.position_modified'))
                    ->success()
                    ->send();
            }
        } else {
            $done = JobTitle::create($data);
            if ($done) {
                Notification::make()
                    ->title(__('messages.position_added'))
                    ->success()
                    ->send();
            }
        }
        $this->form->fill();
        $this->reset();
    }

    public function render()
    {
        return view('livewire.pages.position', [
            'positions' => JobTitle::orderBy('name')->paginate(10),
        ]);
    }
}