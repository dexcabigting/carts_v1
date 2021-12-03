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
        return auth()->user()->unreadNotifications;
    }

    public function markAsRead($id)
    {
        $this->notifications->where('id', $id)->update([
                                                    'read_at' => now(),
                                                ]);
    }
}
