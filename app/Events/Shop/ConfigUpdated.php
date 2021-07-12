<?php

namespace App\Events\Shop;

use App\Models\Shop;
use App\User;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ConfigUpdated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $shop;
    public $user;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Shop $shop, User $user)
    {
        $this->shop = $shop;
        $this->user = $user;
    }
}