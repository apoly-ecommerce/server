<?php

namespace App\Listeners\User;

use App\Events\User\PasswordUpdated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Notifications\User\PasswordUpdated as PasswordUpdateNotification;

class NotifyUserPasswordUpdated implements ShouldQueue
{
    /**
     * The number of times the job may be attempted
     *
     * @var integer
     */
    public $tries = 10;

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
