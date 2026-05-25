<?php

namespace App\Livewire\Competences;

use App\Models\CompetenceTitle;
use App\Traits\TranslationTrait;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use Livewire\Component;

class Title extends Component implements HasForms
{
    use InteractsWithForms, TranslationTrait;

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
        $data = $this->form->getState();
        $current = app()->getLocale();
        $inverse = $current === 'en' ? 'fr' : 'en';
        $data['name'] = [
            $current => $data['name'],
            $inverse => $this->translate($data['name']),
        ];
        $updated = $this->title->update($data);
        if($updated){
            Notification::make()
                        ->title(__('messages.title_updated'))
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