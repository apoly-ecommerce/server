<?php

namespace App\Events\Shop;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ShopDeleted
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $shop_id;

    /**
     * Create a new event instance.
     *
     * @param int $shop_id
     * @return void
     */
    public function __construct($shop_id)
    {
        $this->shop_id = $shop_id;
    }
}
