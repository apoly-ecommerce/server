<?php

namespace App\Listeners\System;

use App\Events\System\DownForMaintenance;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Notifications\System\SystemIsDown as NotifySystemIsDown;

class NotifyAdminSystemIsDown implements ShouldQueue
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
     * @param  DownForMaintenance  $event
     * @return void
     */
    public function handle(DownForMaintenance $event)
    {
        $event->system->superAdmin()->notify(new NotifySystemIsDown($event->system));
    }
}