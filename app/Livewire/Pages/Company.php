<?php

namespace App\Livewire\Pages;

use Livewire\Component;
use Filament\Forms\Form;
use Livewire\Attributes\On;
use Filament\Forms\Contracts\HasForms;
use App\Models\Company as CompanyModel;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Forms\Concerns\InteractsWithForms;
use Livewire\WithPagination;

class Company extends Component implements HasForms
{
    use InteractsWithForms, WithPagination;
    public ?array $data = [];
    public bool $editMode = false;
    public ?CompanyModel $company = null;


    public function mount()
    {
        $this->form->fill();
    }

    public function form(Form $form) : Form 
    {
        return $form->schema([
            TextInput::make('name')->label('Nom')->required(),
            TextInput::make('website')->label('Site web')->url()
        ])
        ->statePath('data');
    }

    public function editCompany(CompanyModel $company)
    {
        $this->editMode = true;
        $this->company = $company;
        $this->form->fill($company->toArray());
        $this->dispatch('scroll-to-form', ['formId' => 'formulaire']);
    }

    #[On('delete-company')]
    public function deleteCompany($data)
    {
        $company = CompanyModel::find($data['id']);
        if($company) {
            $company->delete();
            Notification::make()
                ->title('Entreprise supprimée avec succès')
                ->success()
                ->send();
        }
    }

    public function submit()
    {
        if($this->editMode && $this->company) {
            $done = $this->company->update($this->form->getState());
            if($done)
                Notification::make()
                    ->title('Entreprise modifiée avec succès')
                    ->success()
                    ->send();
        } else {
            $done = CompanyModel::create($this->form->getState());
            if($done)
                Notification::make()
                    ->title('Entreprise ajoutée avec succès')
                    ->success()
                    ->send();
        }
        $this->form->fill();
        $this->reset();
    }
    
    public function render()
    {
        return view('livewire.pages.company', [
            'companies' => CompanyModel::orderBy('name')->paginate(3),
        ]);
    }
}