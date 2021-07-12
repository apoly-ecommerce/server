<?php

namespace App\Http\Resources;

use Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Resources\Json\JsonResource;

class SystemGeneralResource extends JsonResource
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
            "id" => $this->id,
            "install_version" => $this->install_version,
            "maintenance_mode" => $this->maintenance_mode,
            "name" => $this->name,
            "slogan" => $this->slogan,
            "legal_name" => $this->legal_name,
            "email" => $this->email,
            "google_analytic_report" => $this->google_analytic_report,
            "ask_customer_for_email_subscription" => $this->ask_customer_for_email_subscription,
            "support_phone" => $this->support_phone,
            "support_phone_toll_free" => $this->support_phone_toll_free,
            "support_email" => $this->support_email,
            "default_sender_email_address" => $this->default_sender_email_address,
            "default_email_sender_name" => $this->default_email_sender_name,
            "facebook_link" => $this->facebook_link,
            "google_plus_link" => $this->google_plus_link,
            "instagram_link" => $this->instagram_link,
            "youtube_link" => $this->youtube_link,
            "show_currency_symbol" => $this->show_currency_symbol,
            "address_default_country" => $this->address_default_country,
            "address_default_state" => $this->address_default_state,
            "show_address_title" => $this->show_address_title,
            "address_show_country" => $this->address_show_country,
            "address_show_map" => $this->address_show_map,
            "allow_guest_checkout" => $this->allow_guest_checkout,
            "auto_approve_order" => $this->auto_approve_order,
            "notify_when_vendor_registered" => $this->notify_when_vendor_registered,
            "notify_when_dispute_appealed" => $this->notify_when_dispute_appealed,
            "notify_new_message" => $this->notify_new_message,
            "primaryAddress" => $this->primaryAddress,
            "icon_image" => Storage::exists('icon.png') ? get_storage_file_url('icon.png', null).'?'.Hash::make(time()) : null,
            "logo_image" => Storage::exists('logo.png') ? get_storage_file_url('logo.png', null).'?'.Hash::make(time()) : null,
            "enable_chat" => $this->enable_chat,
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at
        ];
    }
}