<?php

namespace App\Http\Resources;

use Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Resources\Json\JsonResource;

class ConfigResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return [
            'shop_id' => $this->shop_id,
            'support_phone' => $this->support_phone,
            'support_phone_toll_free' => $this->support_phone_toll_free,
            'support_email' => $this->support_email,
            'default_sender_email_address' => $this->default_sender_email_address,
            'default_email_sender_name' => $this->default_email_sender_name,
            'return_refund' => $this->return_refund,
            'order_number_prefix' => $this->order_number_prefix,
            'order_number_suffix' => $this->order_number_suffix,
            'default_payment_method_id' => $this->default_payment_method_id,
            'pagination' => $this->pagination,
            'show_shop_desc_with_listing' => $this->show_shop_desc_with_listing,
            'show_refund_policy_with_listing' => $this->show_refund_policy_with_listing,
            'alert_quantity' => $this->alert_quantity,
            'digital_goods_only' => $this->digital_goods_only,
            'notify_new_message' => $this->notify_new_message,
            'notify_alert_quantity' => $this->notify_alert_quantity,
            'notify_inventory_out' => $this->notify_inventory_out,
            'notify_new_order' => $this->notify_new_order,
            'notify_abandoned_checkout' => $this->notify_abandoned_checkout,
            'enable_live_chat' => $this->enable_live_chat,
            'notify_new_chat' => $this->notify_new_chat,
            'maintenance_mode' => $this->maintenance_mode,
            'pending_verification' => $this->pending_verification,
            "icon_image" => Storage::exists('icon.png') ? get_storage_file_url('icon.png', null).'?'.Hash::make(time()) : null,
            "logo_image" => Storage::exists('logo.png') ? get_storage_file_url('logo.png', null).'?'.Hash::make(time()) : null,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
