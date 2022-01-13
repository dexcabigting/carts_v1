<?php

namespace App\Http\Livewire\Notifications;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Notifications\DatabaseNotification;

class NotificationsIndex extends Component
{
    use WithPagination;

    public $notificationType;
    public $notificationId;
    public $isAdmin;
    public $layout;

    public function mount()
    {
        $this->notificationType = 'unreadNotifications';

        if(auth()->user()->role_id == 1) {
            $this->isAdmin = true;

            $this->layout = 'layouts.app';
        } else {    
            $this->isAdmin = false;

            $this->layout = 'layouts.app-user';
        }
    }

    public function render()
    {
        $notificationType = $this->notificationType;

        $notifications = auth()->user()->$notificationType()->paginate(10);

        $layout = $this->layout;

        return view('livewire.notifications.notifications-index', compact('notifications'))->layout($layout);
    }

    public function getNotificationProperty()
    {
        return DatabaseNotification::findOrFail($this->notificationId);
    }

    public function markAsRead($id)
    {
        $this->notificationId = $id;

        $this->notification->markAsRead(); 

        $this->emit('markedAsRead', auth()->user()->unreadNotifications()->count());
    }

    public function delete($id)
    {
        $this->notificationId = $id;

        $this->notification->delete();  
    }
}
