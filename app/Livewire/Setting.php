<?php

namespace App\Livewire;

use App\Models\User;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class Setting extends Component implements HasForms
{
    use InteractsWithForms;

    public User $user;

    public string $email;

    public string $current_password = '*********';

    public bool $change_password = false;
    public bool $show_biography = true;
    public bool $show_portfolio = false;

    public string $password;

    public string $password_confirmation;

    public function mount()
    {
        $this->user = auth()->user()->load('profile');
        $this->email = $this->user->email;
        $this->show_biography = $this->user->profile->show_biography;
        $this->show_portfolio = $this->user->profile->show_portfolio;
    }

    public function form(Form $form): Form
    {
        return $form->schema([
            TextInput::make('email')
                ->email()
                ->required()
                ->unique(),
            TextInput::make('current_password')
                ->label(__('messages.your_password'))
                ->disabled(),
            Checkbox::make('change_password')
                ->label(__('messages.want_change_password'))
                ->live(),
            TextInput::make('password')
                ->label(__('messages.new_password'))
                ->password()
                ->required()
                ->confirmed()
                ->revealable()
                ->hidden(fn ($get) => ! $get('change_password')),
            TextInput::make('password_confirmation')
                ->label(__('messages.confirm_password_label'))
                ->password()
                ->required()
                ->revealable()
                ->hidden(fn ($get) => ! $get('change_password')),
            Section::make(__('messages.setting_profile'))
                ->schema([
                    Checkbox::make('show_biography')
                        ->label(__('messages.show_biography')),
                    Checkbox::make('show_portfolio')
                        ->label(__('messages.show_portfolio'))
                ]),
        ]);
    }

    public function submit()
    {
        $data = $this->form->getState();
        if ($data['change_password']) {
            $data['password'] = Hash::make($data['password']);
        }
        $done = $this->user->update($data);
        $done = $this->user->profile()->update([
            'show_biography' => $data['show_biography'],
            'show_portfolio' => $data['show_portfolio'],
        ]);
        if ($done) {
            Notification::make()
                ->title(__('messages.information_updated'))
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