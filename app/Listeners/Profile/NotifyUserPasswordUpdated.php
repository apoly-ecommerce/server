<?php

namespace App\Listeners\Profile;

use App\Events\Profile\PasswordUpdated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Notifications\User\PasswordUpdated as PasswordUpdateNotification;

class NotifyUserPasswordUpdated implements ShouldQueue
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
     * @param  PasswordUpdated  $event
     * @return void
     */
    public function handle(PasswordUpdated $event)
    {
        $event->user->notify(new PasswordUpdateNotification($event->user));
    }
}
