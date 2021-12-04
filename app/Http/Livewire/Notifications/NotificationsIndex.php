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

    public function mount()
    {
        $this->notificationType = 'unreadNotifications';
    }

    public function render()
    {
        if(auth()->user()->role_id == 1) {

            $layout = 'layouts.app';

        } else {    

            $layout = 'layouts.app-user';
            
        }

        $notificationType = $this->notificationType;

        $notifications = auth()->user()->$notificationType()->paginate(10);

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
    }

    public function delete($id)
    {
        $this->notificationId = $id;

        $this->notification($id)->delete();  
    }
}
