<?php

namespace App\Listeners\Shop;

use App\Events\Shop\DownForMaintenance;
use App\Notifications\Shop\ShopDownForMaintenance;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class NotifyMerchantShopDownForMaintenance implements ShouldQueue
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
        $event->shop->owner->notify(new ShopDownForMaintenance($event->shop));
    }
}