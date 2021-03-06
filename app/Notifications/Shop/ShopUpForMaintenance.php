<?php

namespace App\Notifications\Shop;

use App\Models\Shop;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ShopUpForMaintenance extends Notification implements ShouldQueue
{
    use Queueable;

    public $shop;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Shop $shop)
    {
        $this->shop = $shop;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
        ->from( get_sender_email(), get_sender_name() )
        ->subject( trans('notifications.shop_up_for_maintenance.subject') )
        ->markdown('admin.mail.shop.up_for_maintenance', [
            'url' => 'https://phamdinhhung.com',
            'shop' => $this->shop
        ]);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'name' => $this->shop,
            'status' => trans('messages.shop_up_for_maintenance')
        ];
    }
}