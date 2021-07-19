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

class UserCreated implements ShouldBroadcast
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

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('user');
    }

      /**
       * The event's broadcast name.
       *
       * @return string
       */
      public function broadcastAs()
      {
          return 'user.created';
      }

      /**
     * Get the data to broadcast.
     *
     * @return array
     */
    public function broadcastWith()
    {
        return [
            'id' => $this->user->id,
            'name' => $this->user->name,
            'shop_id' => $this->user->shop_id,
            'creator_id' => $this->user->creator_id,
            'image' => get_storage_file_url(optional($this->user->image)->path, 'medium'),
            'role' => $this->user->role,
            'created_at' => $this->user->created_at,
        ];
    }
}