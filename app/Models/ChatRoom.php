<?php

namespace App\Models;

use App\User;
use App\Common\Imageable;

class ChatRoom extends BaseModel
{
    use Imageable;
    /**
     * The database table used by the model.
     *
     * @var array
     */
    protected $table = 'chat_rooms';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'created_by',
        'shop_id',
        'name',
        'status',
        'description'
    ];

    /**
     * Get the user associated with the chat room.
     */
    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Get the shop associated with the chat room.
     */
    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }

    /**
     * Get the messages for the room.
     */
    public function messages()
    {
        return $this->hasMany(ChatMessage::class);
    }

    /**
     * Get the users for the room.
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'chat_room_user', 'room_id');
    }

    /**
     * Scope a query to only include records from the room.
     */
    public function scopeMyRoom($query)
    {
        // $user_ids = $this->users()->pluck('id')->toArray();

        // return $query->whereIn(\Auth::user()->id, $user_ids);
    }

}