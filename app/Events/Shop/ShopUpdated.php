<?php

namespace App\Events\Shop;

use App\Models\Shop;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ShopUpdated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $shop;

    /**
     * Create a new event instance.
     *
     * @param Shop $shop
     * @return void
     */
    public function __construct(Shop $shop)
    {
        $this->shop = $shop;
    }
}
