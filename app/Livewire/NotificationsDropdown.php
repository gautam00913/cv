<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class NotificationsDropdown extends Component
{
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
            ->unreadNotifications()
            ->latest()
            ->limit(10)
            ->get();

        $unreadCount = Auth::user()
            ->unreadNotifications()
            ->count();

        return view('livewire.notifications-dropdown', compact('notifications', 'unreadCount'));
    }
}