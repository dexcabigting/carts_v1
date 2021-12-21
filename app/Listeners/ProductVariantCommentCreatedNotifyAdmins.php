<?php

namespace App\Listeners;

use App\Events\ProductVariantCommentCreated;

use App\Models\User;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

use Illuminate\Support\Facades\Notification;
use App\Notifications\ProductVariantCommentCreatedNotification;

class ProductVariantCommentCreatedNotifyAdmins
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
     * @param  object  $event
     * @return void
     */
    public function handle(ProductVariantCommentCreated $event)
    {
        //
        $admins = User::where('role_id', 1)->get();

        Notification::send($admins, new ProductVariantCommentCreatedNotification($event->comment));
    }
}
