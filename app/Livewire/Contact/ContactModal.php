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
        $this->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
            ], [
            'full_name.required' => __('messages.full_name_required'),
            'email.required' => __('messages.email_required'),
            'email.email' => __('messages.email_valid'),
            'subject.required' => __('messages.subject_required'),
            'message.required' => __('messages.message_required'),
        ]);

        $data = [
            'full_name' => $this->full_name,
            'email' => $this->email,
            'phone' => $this->phone,
            'subject' => $this->subject,
            'message' => $this->message,
        ];
        // verification de la validité de l'adresse email de l'utilisateur
        if (! EmailChecker::check($this->email)) {
            $this->addError('email', __('messages.email_invalid'));

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
