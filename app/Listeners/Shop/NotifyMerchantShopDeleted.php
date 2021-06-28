<?php

namespace App\Listeners\Shop;

use App\Events\Shop\ShopDeleted;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Notifications\Shop\ShopDeleted as ShopDeletedNotification;

class NotifyMerchantShopDeleted implements ShouldQueue
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
     * @param  ShopDeleted  $event
     * @return void
     */
    public function handle(ShopDeleted $event)
    {
        $shop = \App\Models\Shop::withTrashed()->find($event->shop_id);
        $merchant = \App\User::withTrashed()->find($shop->owner_id);

        $merchant->notify(new ShopDeletedNotification());
    }
}
