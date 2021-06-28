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
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'maintenance_mode' => 'boolean',
        'pending_verification' => 'boolean',
        'auto_archive_order' => 'boolean',
        'digital_goods_only' => 'boolean',
        'notify_new_disput' => 'boolean',
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
        'default_tax_id',
        'order_handling_cost',
        'auto_archive_order',
        'default_payment_method_id',
        'pagination',
        'show_shop_desc_with_listing',
        'show_refund_policy_with_listing',
        'alert_quantity',
        'digital_goods_only',
        'default_warehouse_id',
        'default_supplier_id',
        'default_packaging_ids',
        'notify_new_message',
        'notify_alert_quantity',
        'notify_inventory_out',
        'notify_new_order',
        'notify_abandoned_checkout',
        'notify_new_disput',
        'maintenance_mode',
        'pending_verification'
    ];

    /**
     * Get the shop.
     */
    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }

}
