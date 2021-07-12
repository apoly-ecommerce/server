<?php

namespace App\Models;

class Config extends BaseModel
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'configs';

    /**
     * The database primary key used by the model.
     *
     * @var string
     */
    protected $primaryKey = 'shop_id';

    /**
     * The primary key is not incrementing.
     *
     * @var boolean
     */
    public $incrementing = false;

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'maintenance_mode' => 'boolean',
        'pending_verification' => 'boolean',
        'digital_goods_only' => 'boolean',
        'notify_new_message' => 'boolean',
        'notify_alert_quantity' => 'boolean',
        'notify_inventory_out' => 'boolean',
        'notify_new_order' => 'boolean',
        'notify_abandoned_checkout' => 'boolean',
        'enable_live_chat' => 'boolean',
        'notify_new_chat' => 'boolean',
    ];

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
        'return_refund',
        'order_number_prefix',
        'order_number_suffix',
        'default_payment_method_id',
        'pagination',
        'show_shop_desc_with_listing',
        'show_refund_policy_with_listing',
        'alert_quantity',
        'digital_goods_only',
        'notify_new_message',
        'notify_alert_quantity',
        'notify_inventory_out',
        'notify_new_order',
        'notify_abandoned_checkout',
        'maintenance_mode',
        'pending_verification',
        'enable_live_chat',
        'notify_new_chat'
    ];

    /**
     * Get the shop.
     */
    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }

    /**
     * Get supper agent
     */
    public function supportAgent()
    {
        return $this->belongsTo(App\User::class, 'support_agent');
    }

    /**
     * Check if Chat enabled.
     *
     * @return boolean
     */
    public function isChatEnabled()
    {
        return $this->enable_live_chat;
    }

    /**
     * Scope a query to only include active shops.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeLive($query)
    {
        return $query->where('maintenance_mode', 0)->whereNull('maintenance_mode');
    }

    /**
     * Scope a query to only include shops thats are down for maintenance.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeDown($query)
    {
        return $query->where('maintenance_mode', 1);
    }
}