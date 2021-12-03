<?php

namespace App\Http\Livewire;

use Livewire\Component;

class NotificationIndex extends Component
{
    public function render()
    {
        $notifications = $this->notifications;

        return view('livewire.notification-index', compact('notifications'));
    }

    public function getNotificationsProperty()
    {
        $auth = auth()->user();

        if($auth->role_id == 1) {
            return $auth->unreadNotifications->where('type', 'App\Notifications\OrderCreatedNotification')->get();
        } else {
            return $auth->unreadNotifications;
        }
            
    }

    public function markAsRead()
    {

    }
}
