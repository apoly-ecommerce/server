<?php

namespace App\Listeners\Shop;

use App\Events\Shop\UpForMaintenance;
use App\Notifications\Shop\ShopUpForMaintenance;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class NotifyMerchantShopUpForMaintenance implements ShouldQueue
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
        $event->shop->owner->notify(new ShopUpForMaintenance($event->shop));
    }
}