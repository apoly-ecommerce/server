<?php

namespace App\Events\Profile;

use App\User;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PasswordUpdated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $user;

    /**
     * Create a new event instance.
     *
     * @param  user  $user
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }
}
