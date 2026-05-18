<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class AllNotifications extends Component
{
    use WithPagination;
    
    public function markAsRead(string $notificationId): void
    {
        $notification = Auth::user()->notifications()->find($notificationId);

        if ($notification) {
            $notification->markAsRead();
        }
    }

    public function markAllAsRead(): void
    {
        Auth::user()->unreadNotifications->markAsRead();
    }

    public function render()
    {
        $notifications = Auth::user()
            ->notifications()
            ->latest()
            ->paginate(10);

        $unreadCount = Auth::user()
            ->unreadNotifications()
            ->count();

        return view('livewire.all-notifications', compact('notifications', 'unreadCount'));
    }
}