<?php

namespace App\Models;

use App\Common\Attachable;

class Reply extends BaseModel
{

    use Attachable;
    /**
     * The database table used by this model.
     *
     * @var string
     */
    protected $table = 'replies';

    /**
     * The attributes that should be casted to boolean types.
     *
     * @var array
     */
    protected $casts = [
        'read' => 'boolean',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $attributes = [
        'reply',
        'user_id',
        'customer_id',
        'read',
        'repliable_id',
        'repliable_type',
    ];

    /**
     * Get all of the owning replies model.
     */
    public function replies()
    {
        return $this->morphTo();
    }

    /**
     * Get the user associated with the model.
     */
    public function user()
    {
        return $this->belongsTo(User::class)->withDefault([
            'name' => trans('app.user')
        ]);
    }

    /**
     * Get the customer associated with the model
     */
    public function customer()
    {
        return $this->belongsTo(Customer::class)->withDefault([
            'name' => trans('app.guest_customer')
        ]);
    }

    /**
     * Get the sender name.
     */
    public function getName()
    {
        $user = $this->customer_id ? $this->customer : $this->user;

        return $user->getName();
    }

    /**
     * Get the sender avatar
     */
    public function getAvatar()
    {
        $user = $this->customer_id ? $this->customer : $this->user;

        return get_storage_file_url(optional($user, 'mini'));
    }

}
