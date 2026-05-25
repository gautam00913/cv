<?php

namespace App\Livewire\Profile;

use App\Models\User;
use App\Traits\TranslationTrait;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use Livewire\Attributes\Rule;
use Livewire\Component;

class ShowProfile extends Component implements HasForms
{
    use InteractsWithForms, TranslationTrait;

    public User $user;

    #[Rule('required|min:10|max:255')]
    public $name;

    #[Rule('required|email|max:255')]
    public $email;

    #[Rule('required|regex:/^+[0-9]+ $/{10,}')]
    public $phone;

    #[Rule('required|min:10|max:100')]
    public $biography;

    #[Rule('sometimes|image')]
    public $picture;

    public function mount()
    {
        $this->user = auth()->user()->load('profile');
        $this->form->fill([
            'name' => $this->user->name,
            'email' => $this->user->email,
            'phone' => $this->user->phone,
            'biography' => $this->user->profile->biography,
            'picture' => $this->user->profile->picture,
        ]);
    }

    public function submit()
    {
        $this->validate();
        $state = $this->form->getState();
        $update = $this->user->update([
            'name' => $state['name'],
            'phone' => $state['phone'],
            'email' => $state['email'],
        ]);
        $tab = [];
        if ($state['picture']) {
            $tab['picture'] = $state['picture'];
        }

        $current = app()->getLocale();
        $inverse = $current === 'en' ? 'fr' : 'en';
        $update = $this->user->profile()->update([
            'biography' => [
                $current => $state['biography'],
                $inverse => $state['biography'] ? $this->translate($state['biography']) : null,
            ],
        ] + $tab);
        if ($update) {
            Notification::make()
                ->title(__('messages.modification_done_success'))
                ->success()
                ->send();
        }
    }

    protected function getFormSchema(): array
    {
        return [
            TextInput::make('name')->label(__('messages.name_lastname'))->required(),
            TextInput::make('email')->email()->required(),
            TextInput::make('phone')->label(__('messages.phone_number'))->tel()->telRegex('/^[+]*[(]{0,1}[0-9]{1,4}[)]{0,1}[-\s\.\/0-9]*$/')->required(),
            Textarea::make('biography')->label(__('messages.biography'))->rows(3)->nullable()->minLength(10)->maxLength(100),
            FileUpload::make('picture')->label(__('messages.profile_picture'))->image()->directory('images'),
        ];
    }

    public function render()
    {
        return view('livewire.profile.show-profile');
    }
}