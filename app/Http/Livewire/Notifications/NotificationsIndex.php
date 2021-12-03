<?php

namespace App\Http\Livewire\Notifications;

use Livewire\Component;

class NotificationsIndex extends Component
{
    public function render()
    {
        $notifications = $this->notifications;

        return view('livewire.notifications.notifications-index', compact('notifications'));
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
