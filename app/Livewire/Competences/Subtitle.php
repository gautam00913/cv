<?php

namespace App\Livewire\Competences;

use App\Models\CompetenceSubTitle;
use App\Traits\TranslationTrait;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use Livewire\Component;

class Subtitle extends Component implements HasForms
{
    use InteractsWithForms, TranslationTrait;

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
        $data = $this->form->getState();
        $current = app()->getLocale();
        $inverse = $current === 'en' ? 'fr' : 'en';
        $data['name'] = [
            $current => $data['name'],
            $inverse => $this->translate($data['name']),
        ];
        $updated = $this->subtitle->update($data);
        if($updated){
            Notification::make()
                        ->title(__('messages.subtitle_updated'))
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