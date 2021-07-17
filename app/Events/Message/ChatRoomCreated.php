<?php

namespace App\Events\Message;

use App\Http\Resources\ChatRoomResource;
use App\Models\ChatRoom;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ChatRoomCreated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $chatRoom;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(ChatRoom $chatRoom)
    {
        $this->chatRoom = $chatRoom;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('chatRoom');
    }

      /**
       * The event's broadcast name.
       *
       * @return string
       */
      public function broadcastAs()
      {
          return 'chatRoom.created';
      }

    /**
     * Get the data to broadcast.
     *
     * @return array
     */
    public function broadcastWith()
    {
        return [
            // 'room' => new ChatRoomResource($this->chatRoom),
            'id' => $this->chatRoom->id,
            'name' => $this->chatRoom->name,
            'user_created' => [
              'id' => $this->chatRoom->userCreated->id,
              'name' => $this->chatRoom->userCreated->name,
              'nice_name' => $this->chatRoom->userCreated->name,
            ],
            'description' => $this->chatRoom->description,
            'status' => $this->chatRoom->status,
            'image' => get_storage_file_url(optional($this->chatRoom->image)->path, 'medium'),
            'invited_users' => $this->chatRoom->users->pluck('id')->toArray()
        ];
    }
}