<?php

namespace App\Events\System;

use App\Models\SystemConfig;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class SystemConfigUpdated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $system;

    /**
     * Create a new event instance.
     *
     * @param \App\Models\System  $system
     * @return void
     */
    public function __construct(SystemConfig $system)
    {
        $this->system = $system;
    }
}
