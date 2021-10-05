<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;

class RegisteredUserNotification extends SendEmailVerificationNotification implements ShouldQueue
{
    use Queueable;
}
