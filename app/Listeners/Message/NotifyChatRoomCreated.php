<?php

namespace App\Listeners\Message;

use App\Events\Message\ChatRoomCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class NotifyChatRoomCreated
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
     * @param  ChatRoomCreated  $event
     * @return void
     */
    public function handle(ChatRoomCreated $event)
    {
        //
    }
}
