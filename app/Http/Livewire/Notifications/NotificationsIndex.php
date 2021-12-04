<?php

namespace App\Http\Livewire\Notifications;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Notifications\DatabaseNotification;

class NotificationsIndex extends Component
{
    use WithPagination;

    public $notificationType;

    protected $listeners = [
        'refresh' => '$refresh',
    ];

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

    public function getAuthNotificationsProperty()
    {
        $notificationType = $this->notificationType;

        return auth()->user()->$notificationType();
    }

    public function markAsRead($id)
    {
        $this->auth_notifications->where('id', $id)->markAsRead(); 

        // $this->emit('refresh');
    }

    public function delete($id)
    {
        auth()->user()->unreadNotifications()->where('id', $id)->delete(); 

        // $this->emit('refresh');
    }
}
