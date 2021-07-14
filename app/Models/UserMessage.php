<?php

namespace App\Models;

use App\Common\Imageable;

class UserMessage extends BaseModel
{
    use Imageable;

    const STATUS_NEW    = 1; // Default
    const STATUS_UNREAD = 2; // All status before UNREAD value consider as unread
    const STATUS_READ   = 3;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'user_messages';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'source_id',
        'target_id',
        'message',
        'status'
    ];

    /**
     * Get the user source associated with the model.
     */
    public function source()
    {
        return $this->belongsTo(User::class, 'source_id');
    }

    /**
     * Get the user target associated with the model.
     */
    public function target()
    {
        return $this->belongsTo(User::class, 'target_id');
    }

}