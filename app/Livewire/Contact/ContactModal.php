<?php

namespace App\Livewire\Contact;

use App\Mail\ContactMail;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Livewire\Attributes\On;
use Livewire\Component;
use Tintnaingwin\EmailChecker\Facades\EmailChecker;

class ContactModal extends Component
{
    public bool $showModal = false;

    public bool $isSuccess = false;

    public string $full_name = '';

    public string $email = '';

    public ?string $phone = null;

    public string $subject = '';

    public string $message = '';

    protected function rules(): array
    {
        return [
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ];
    }

    protected $messages = [
        'full_name.required' => 'Le nom et prénom est obligatoire.',
        'email.required' => 'L\'email est obligatoire.',
        'email.email' => 'L\'email doit être valide.',
        'subject.required' => 'L\'objet est obligatoire.',
        'message.required' => 'Le message est obligatoire.',
    ];

    public function render()
    {
        return view('livewire.contact.contact-modal');
    }

    #[On('openContactModal')]
    public function openModal(): void
    {
        $this->showModal = true;
        $this->isSuccess = false;
        $this->resetForm();
    }

    public function closeModal(): void
    {
        $this->showModal = false;
        $this->resetForm();
    }

    public function submit(): void
    {
        $this->validate();

        $data = [
            'full_name' => $this->full_name,
            'email' => $this->email,
            'phone' => $this->phone,
            'subject' => $this->subject,
            'message' => $this->message,
        ];
        //verification de la validité de l'adresse email de l'utilisateur
        if(!EmailChecker::check($this->email)){
            $this->addError('email', 'L\'adresse email est invalide.');
            return;
        }

        $user = User::first();

        if ($user && $user->email) {
            Mail::to($user->email)->send(new ContactMail($data));
        }

        $user->notify(new \App\Notifications\ContactNotification($data));

        $this->isSuccess = true;
    }

    protected function resetForm(): void
    {
        $this->full_name = '';
        $this->email = '';
        $this->phone = null;
        $this->subject = '';
        $this->message = '';
        $this->resetErrorBag();
    }
}