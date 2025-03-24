<?php

namespace App\Livewire\Competences;

use Livewire\Component;
use App\Models\CompetenceTitle;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Notifications\Notification;

class Title extends Component implements HasForms
{
    use InteractsWithForms;

    public CompetenceTitle $title;
    public string $name;

    public function mount(CompetenceTitle $title){
        $this->title = $title;
        $this->name = $title->name;
    }

    protected function getFormSchema(): array
    {
        return [
            TextInput::make('name')->label('Titre')->required()
        ];
    }

    public function submit(){
        $updated = $this->title->update($this->form->getState());
        if($updated){
            Notification::make()
                        ->title("Catégorie de compétence mise à jour avec succès")
                        ->success()
                        ->send();
            return $this->redirect(route('competences', absolute: false), true);
        }
    }

    public function render()
    {
        return view('livewire.competences.title');
    }
}
