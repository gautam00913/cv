<?php

namespace App\Livewire\Profile;

use App\Models\User;
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
    use InteractsWithForms;
    
    public User $user;

    #[Rule('required|min:10|max:255')]
    public $name;

    #[Rule('required|email|max:255')]
    public $email;

    #[Rule('required|regex:/^+[0-9]+ $/{10,}')]
    public $phone;

    #[Rule('required|min:10|max:400')]
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
        $state =$this->form->getState();
        $update = $this->user->update([
            'name' => $state['name'],
            'phone' => $state['phone'],
            'email' => $state['email'],
        ]);
        $tab = [];
        if($state['picture'])
            $tab['picture'] = $state['picture'];

        $update = $this->user->profile()->update([
            'biography' => $state['biography']
        ] + $tab);
        if($update){
            Notification::make()
                ->title('Modification éffectuée avec succès')
                ->success()
                ->send();
        }
    }

    protected function getFormSchema(): array
    {
        return [
            TextInput::make('name')->required(),
            TextInput::make('email')->email()->required(),
            TextInput::make('phone')->tel()->telRegex('/^[+]*[(]{0,1}[0-9]{1,4}[)]{0,1}[-\s\.\/0-9]*$/')->required(),
            Textarea::make('biography'),
            FileUpload::make('picture')->image()->directory('images')
        ];
    }

    public function render()
    {
        return view('livewire.profile.show-profile');
    }
}
