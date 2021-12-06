<?php

namespace App\Http\Livewire\Notifications;

use Livewire\Component;

class NotificationsCounter extends Component
{
    public $notifCount;

    protected $listeners = [
        'markedAsRead' => 'updateNotifCount',
    ];

    public function render()
    {
        $this->notifCount = auth()->user()->unreadNotifications()->count();

        return view('livewire.notifications.notifications-counter');
    }

    public function updateNotifCount($notifCount)
    {
        return $this->notifCount = $notifCount;
    }
}
