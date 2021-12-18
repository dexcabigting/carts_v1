<?php

namespace App\Listeners;

use App\Events\Registered;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

use App\Models\User;
use Illuminate\Support\Facades\Notification;
use App\Notifications\RegisteredNotification;

class RegisteredNotifyAdmins
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\Registered  $event
     * @return void
     */
    public function handle(Registered $event)
    {
        //
        $admins = User::where('role_id', 1)->get();

        Notification::send($admins, new RegisteredNotification($event->user));
    }
}
