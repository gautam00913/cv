<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Filament\Forms\Form;
use Illuminate\Support\Facades\Hash;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Forms\Concerns\InteractsWithForms;

class Setting extends Component implements HasForms
{
    use InteractsWithForms;

    public User $user;
    public string $email;
    public string $current_password = "*********";
    public bool $change_password = false;
    public string $password;
    public string $password_confirmation;

    public function mount()
    {
        $this->user = auth()->user();
        $this->email = $this->user->email;
    }

    public function form(Form $form) : Form
    {
        return $form->schema([
            TextInput::make('email')
                    ->email()
                    ->required()
                    ->unique(),
            TextInput::make('current_password')
                    ->label("Votre mot de passe")
                    ->disabled(),
            Checkbox::make('change_password')
                    ->label("Je veux changer mon mot de passe")
                    ->live(),
            TextInput::make('password')
                    ->label("Nouveau mot de passe")
                    ->password()
                    ->required()
                    ->confirmed()
                    ->revealable()
                    ->hidden(fn ($get) => !$get('change_password')),
            TextInput::make('password_confirmation')
                    ->label("Confirmer le mot de passe")
                    ->password()
                    ->required()
                    ->revealable()
                    ->hidden(fn ($get) => !$get('change_password')),
        ]);
    }

    public function submit()
    {
        $data = $this->form->getState();
        if($data['change_password'])
            $data['password'] = Hash::make($data['password']);
        $done = $this->user->update($data);
        if($done)
        {
            Notification::make()
                        ->title("Informations mise à jour avec succès")
                        ->success()
                        ->send();
            $this->reset(['change_password', 'password', 'password_confirmation']);
        }
    }

    public function render()
    {
        return view('livewire.setting');
    }
}
