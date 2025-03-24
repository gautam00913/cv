<?php

namespace App\Livewire\Competences;

use Livewire\Component;
use App\Models\CompetenceSubTitle;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Forms\Concerns\InteractsWithForms;

class Subtitle extends Component implements HasForms
{
    use InteractsWithForms;

    public CompetenceSubTitle $subtitle;
    public string $name;

    public function mount(CompetenceSubTitle $subtitle)
    {
        $this->subtitle = $subtitle;
        $this->name = $subtitle->name;
    }

    protected function getFormSchema(): array
    {
        return [
            TextInput::make('name')->label('Titre')->required()
        ];
    }

    public function submit(){
        $updated = $this->subtitle->update($this->form->getState());
        if($updated){
            Notification::make()
                        ->title("Sous-catégorie de compétence mise à jour avec succès")
                        ->success()
                        ->send();
            return $this->redirect(route('competences', absolute: false), true);
        }
    }

    public function render()
    {
        return view('livewire.competences.subtitle');
    }
}
