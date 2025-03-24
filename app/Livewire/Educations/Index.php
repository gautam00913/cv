<?php

namespace App\Livewire\Educations;

use Livewire\Component;
use Filament\Forms\Form;
use App\Models\Education;
use Filament\Forms\Components\RichEditor;
use Livewire\Attributes\Computed;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Forms\Concerns\InteractsWithForms;
use Livewire\Attributes\On;

class Index extends Component implements HasForms
{
    use InteractsWithForms;

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
        $this->education = new Education();
        $this->form->fill();
    }

    public function edit(int $id)
    {
        $this->education = Education::findOrFail($id);
        $this->editMode = true;
        $this->form->fill($this->education->toArray());
    }

    #[On('delete-education')]
    public function destroy(int $id)
    {
        $this->education = Education::findOrFail($id);
        $done = $this->education->delete();
        if($done)
        {
            $this->dispatch('close-delete-modal');
            Notification::make()
                        ->title("éducation suprimée avec succès")
                        ->success()
                        ->send();
        }
        $this->refresh();
    }

    public function form(Form $form) : Form
    {
        return $form->schema([
            TextInput::make('grade')
                        ->label("Diplôme obtenu")
                        ->required(),
            RichEditor::make('description')
                    ->maxLength(500)
                    ->required(),
            TextInput::make('year')
                        ->label("Année d'obtention")
                        ->numeric()
                        ->minValue(1)
                        ->required()
        ])
        ->statePath('data')
        ->model($this->education);
    }

    public function submit()
    {
        if($this->editMode)
        {
            $done = $this->education->update($this->form->getState());
            if($done)
            {
                Notification::make()
                            ->title("Education modifiée avec succès")
                            ->success()
                            ->send();
                $this->reset('editMode');
            }
        }else{
            $done = auth()->user()->profile->educations()->create($this->form->getState());
            if($done)
            {
                Notification::make()
                            ->title("Education ajoutée avec succès")
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

    private function refresh() : void
    {
        unset($this->educations);
    }
}
