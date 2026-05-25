<?php

namespace App\Livewire\Pages;

use App\Models\Company as CompanyModel;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Livewire\Attributes\On;
use Livewire\Component;
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

    public function form(Form $form): Form
    {
        return $form->schema([
            TextInput::make('name')->label(__('messages.name'))->required(),
            TextInput::make('website')->label(__('messages.website'))->url(),
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
    public function deleteCompany(int $id)
    {
        $company = CompanyModel::find($id);
        if ($company) {
            $company->delete();
            Notification::make()
                ->title(__('messages.company_deleted'))
                ->success()
                ->send();

            return $this->dispatch('close-delete-modal');
        }
    }

    public function submit()
    {
        if ($this->editMode && $this->company) {
            $done = $this->company->update($this->form->getState());
            if ($done) {
                Notification::make()
                    ->title(__('messages.company_modified'))
                    ->success()
                    ->send();
            }
        } else {
            $done = CompanyModel::create($this->form->getState());
            if ($done) {
                Notification::make()
                    ->title(__('messages.company_added'))
                    ->success()
                    ->send();
            }
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