<?php

namespace App\Livewire\Pages;

use Livewire\Component;
use App\Models\JobTitle;
use Filament\Forms\Form;
use Livewire\Attributes\On;
use Livewire\WithPagination;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Forms\Concerns\InteractsWithForms;

class Position extends Component implements HasForms
{
    use InteractsWithForms, WithPagination;
    public ?array $data = [];
    public bool $editMode = false;
    public ?JobTitle $jobTitle = null;


    public function mount()
    {
        $this->form->fill();
    }

    public function form(Form $form) : Form 
    {
        return $form->schema([
            TextInput::make('name')->label('Nom')->required(),
        ])
        ->statePath('data');
    }

    public function editPosition(JobTitle $jobTitle)
    {
        $this->editMode = true;
        $this->jobTitle = $jobTitle;
        $this->form->fill($jobTitle->toArray());
        $this->dispatch('scroll-to-form', ['formId' => 'formulaire']);
    }

    #[On('delete-position')]
    public function deletePosition($data)
    {
        $jobTitle = JobTitle::find($data['id']);
        if($jobTitle) {
            $jobTitle->delete();
            Notification::make()
                ->title('Poste supprimée avec succès')
                ->success()
                ->send();
        }
    }

    public function submit()
    {
        if($this->editMode && $this->jobTitle) {
            $done = $this->jobTitle->update($this->form->getState());
            if($done)
                Notification::make()
                    ->title('Poste modifiée avec succès')
                    ->success()
                    ->send();
        } else {
            $done = JobTitle::create($this->form->getState());
            if($done)
                Notification::make()
                    ->title('Poste ajoutée avec succès')
                    ->success()
                    ->send();
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