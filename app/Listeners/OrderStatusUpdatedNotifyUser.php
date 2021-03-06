<?php

namespace App\Listeners;

use App\Events\OrderStatusUpdated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\User;

use Illuminate\Support\Facades\Notification;
use App\Notifications\OrderStatusUpdatedNotification;

class OrderStatusUpdatedNotifyUser
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
     * @param  OrderStatusUpdated  $event
     * @return void
     */
    public function handle(OrderStatusUpdated $event)
    {
        //
        $user = User::where('id', $event->order->user_id)->first();

        Notification::send($user, new OrderStatusUpdatedNotification($event->order));
    }
}
