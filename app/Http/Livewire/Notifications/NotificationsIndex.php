<?php

namespace App\Http\Livewire\Notifications;

use Livewire\Component;
use Illuminate\View\View;

class NotificationsIndex extends Component
{
    public $notificationType;

    protected $listeners = [
        'refresh' => '$refresh',
    ];

    public function mount()
    {
        $this->notificationType = 'unreadNotifications';
    }

    public function render(): View
    {
        if(auth()->user()->role_id == 1) {
            $layout = 'layouts.app';
        } else {    
            $layout = 'layouts.app-user';
        }

        $notifications = $this->auth_notifications;

        return view('livewire.notifications.notifications-index', compact('notifications'))->layout($layout);
    }

    public function getAuthNotificationsProperty()
    {
        $notificationType = $this->notificationType;

        return auth()->user()->$notificationType;
    }

    public function markAsRead($id)
    {
        $this->auth_notifications->where('id', $id)->markAsRead(); 

        $this->emit('refresh');
    }

    public function delete($id)
    {
        auth()->user()->unreadNotifications()->where('id', $id)->delete(); 

        $this->emit('refresh');
    }
}
