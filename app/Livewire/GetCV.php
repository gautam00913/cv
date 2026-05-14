<?php

namespace App\Livewire;

use App\Models\User;
use App\Traits\CVGenerator;
use Livewire\Attributes\On;
use Livewire\Component;
use Tintnaingwin\EmailChecker\Facades\EmailChecker;

class GetCv extends Component
{
    use CVGenerator;
    
    public bool $showModal = false;

    public string $email = '';
    public ?int $id = null;

    protected function rules(): array
    {
        return [
            'email' => 'required|email|max:255',
        ];
    }

    protected $messages = [
        'email.required' => 'L\'email est obligatoire.',
        'email.email' => 'L\'email doit être valide.',
    ];

    #[On('openCVModal')]
    public function openModal(?int $id = null): void
    {
        $this->id = $id;
        $this->showModal = true;
        $this->resetForm();
    }

    public function closeModal(): void
    {
        $this->showModal = false;
        $this->resetForm();
    }

    public function download()
    {
        $this->validate();
 
        //verification de la validité de l'adresse email de l'utilisateur
        if(!EmailChecker::check($this->email)){
            return $this->addError('email', 'L\'adresse email est invalide.');
        }

        $user = User::findOrFail($this->id);
        $data = [
            'email' => $this->email,
            'ip_address' => session()->get('ip_address', request()->ip()),
        ];
        ['pdf' => $pdf, 'name' => $name] = $this->generateCV($this->id);

        $user->notify(new \App\Notifications\CVDownloadNotification($data));

        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->output();
        }, $name, [
            'Content-Type' => 'application/pdf',
        ]);
    }
    
    public function render()
    {
        return view('livewire.get-cv');
    }

     protected function resetForm(): void
    {
        $this->email = '';
        $this->resetErrorBag();
    }
}