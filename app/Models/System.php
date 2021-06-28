<?php

namespace App\Models;

use App\Common\Imageable;
use App\Common\Addressable;
use App\Common\SystemUser;
use Illuminate\Notifications\Notifiable;

class System extends BaseModel
{
    use SystemUser, Notifiable, Addressable, Imageable;
    /**
     * The app version
     *
     * @var string
     */
    const VERSION = '1.1.1';

    /**
     * The database table used by the model.
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
        'install_version',
        'maintenance_mode',
        'name',
        'slogan',
        'legal_name',
        'email',
        'google_analytic_report',
        'ask_customer_for_email_subscription',
        'support_phone',
        'support_phone_toll_free',
        'support_email' => '',
        'default_sender_email_address',
        'default_email_sender_name',
        'facebook_link' => '',
        'google_plus_link',
        'instagram_link',
        'youtube_link',
        'show_currency_symbol',
        'address_default_country',
        'address_default_state',
        'show_address_title',
        'address_show_country',
        'address_show_map',
        'allow_guest_checkout',
        'auto_approve_order',
        'notify_when_vendor_registered',
        'notify_when_dispute_appealed',
        'notify_new_message',
        'enable_chat'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'maintenance_mode' => 'boolean',
        'google_analytic_report' => 'boolean',
        'ask_customer_for_email_subscription' => 'boolean',
        'show_currency_symbol' => 'boolean',
        'show_address_title' => 'boolean',
        'address_show_country' => 'boolean',
        'address_show_map' => 'boolean',
        'allow_guest_checkout' => 'boolean',
        'auto_approve_order' => 'boolean',
        'notify_when_vendor_registered' => 'boolean',
        'notify_when_dispute_appealed' => 'boolean',
        'notify_new_message' => 'boolean',
        'enable_chat' => 'boolean'
    ];

    /**
     * Route notifications for the mail channel.
     *
     * @return string
     */
    public function routeNotificationForMail()
    {
        return $this->support_email ? $this->support_email : $this->email;
    }

    /**
     * Check if the system is down or live.
     *
     * @return bool
     */
    public function isDown()
    {
        return $this->maintenance_mode;
    }
}