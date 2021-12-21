<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use App\Listeners\RegisteredNotifyAdmins;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

use App\Events\OrderStatusUpdated;
use App\Listeners\OrderStatusUpdatedNotifyUser;
use App\Events\OrderCreated;
use App\Listeners\OrderCreatedNotifyAdmins;
use App\Events\ProductVariantCommentCreated;
use App\Listeners\ProductVariantCommentCreatedNotifyAdmins;
use App\Models\ProductVariantComment;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
            RegisteredNotifyAdmins::class,
        ],
        OrderStatusUpdated::class => [
            OrderStatusUpdatedNotifyUser::class,
        ],
        OrderCreated::class => [
            OrderCreatedNotifyAdmins::class,
        ],
        ProductVariantCommentCreated::class => [
            ProductVariantCommentCreatedNotifyAdmins::class,
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
