<?php

namespace App\Listeners\System;

use App\Events\System\UpForMaintenance;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Notifications\System\SystemIsUp as NotifySystemIsUp;

class NotifyAdminSystemIsUp implements ShouldQueue
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
     * @param  UpForMaintenance  $event
     * @return void
     */
    public function handle(UpForMaintenance $event)
    {
        $event->system->superAdmin()->notify(new NotifySystemIsUp($event->system));
    }
}