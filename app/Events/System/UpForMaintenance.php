<?php

namespace App\Events\System;

use App\Models\System;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UpForMaintenance
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $system;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(System $system)
    {
        $this->system = $system;
    }
}
