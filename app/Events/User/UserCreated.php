<?php

namespace App\Events\User;

use App\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UserCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $user;
    public $admin;
    public $password;

    /**
     * Create a new event instance.
     *
     * @param instance $user
     * @param string $admin
     * @param string $password
     * @return void
     */
    public function __construct(User $user, $admin, $password)
    {
        $this->user = $user;
        $this->admin = $admin;
        $this->password = $password;
    }
}
