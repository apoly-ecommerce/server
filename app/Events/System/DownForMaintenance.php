<?php

namespace App\Events\System;

use App\Models\System;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class DownForMaintenance
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
