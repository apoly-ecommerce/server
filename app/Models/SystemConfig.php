<?php

namespace App\Models;

use App\Common\SystemUser;

class SystemConfig extends BaseModel
{
    use SystemUser;

    /**
     * The database table table used by the model.
     *
     * @var string
     */
    protected $table = 'systems';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'support_phone',
        'support_phone_toll_free',
        'support_email',
        'default_sender_email_address',
        'default_email_sender_name',
        'address_default_country',
        'address_default_state',
        'show_address_title',
        'address_show_country',
        'address_show_map',
        'notify_when_vendor_registered',
        'notify_new_message',
        'enable_chat'
    ];

    /**
     * The attributes that should be casted to boolean types.
     *
     * @var array
     */
    protected $casts = [
        'show_address_title' => 'boolean',
        'address_show_country' => 'boolean',
        'address_show_map' => 'boolean',
        'notify_when_vendor_registered' => 'boolean',
        'notify_new_message' => 'boolean',
        'enable_chat' => 'boolean'
    ];
}
