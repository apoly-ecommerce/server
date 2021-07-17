<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        // User Events
        'App\Events\User\UserCreated' => [
            'App\Listeners\User\SendLoginInfo'
        ],
        'App\Events\User\UserUpdated' => [
            'App\Listeners\User\NotifyUserProfileUpdated'
        ],
        'App\Events\User\PasswordUpdated' => [
            'App\Listeners\User\NotifyUserPasswordUpdated'
        ],
        // Customer Events
        'App\Events\Customer\PasswordUpdated' => [
            'App\Listeners\Customer\NotifyCustomerPasswordUpdated'
        ],
        // Shop Events
        'App\Events\Shop\ShopCreated' => [
            'App\Listeners\Shop\NotifyMerchantShopCreated'
        ],
        'App\Events\Shop\ShopUpdated' => [
            'App\Listeners\Shop\NotifyMerchantShopUpdated'
        ],
        'App\Events\Shop\ShopDeleted' => [
            'App\Listeners\Shop\NotifyMerchantShopDeleted'
        ],
        'App\Events\Shop\DownForMaintenance' => [
            'App\Listeners\Shop\NotifyMerchantShopDownForMaintenance'
        ],
        'App\Events\Shop\UpForMaintenance' => [
            'App\Listeners\Shop\NotifyMerchantShopUpForMaintenance'
        ],
        'App\Events\Shop\ConfigUpdated' => [
            'App\Listeners\Shop\NotifyMerchantConfigUpdated'
        ],
        // Profile Events
        'App\Events\Profile\PasswordUpdated' => [
            'App\Listeners\Profile\NotifyUserPasswordUpdated'
        ],
        'App\Events\Profile\ProfileUpdated' => [
            'App\Listeners\Profile\NotifyUserProfileUpdated'
        ],
        // System Events
        'App\Events\System\DownForMaintenance' => [
            'App\Listeners\System\NotifyAdminSystemIsDown'
        ],
        'App\Events\System\UpForMaintenance' => [
            'App\Listeners\System\NotifyAdminSystemIsUp'
        ],
        'App\Events\System\SystemConfigUpdated' => [
            'App\Listeners\System\NotifyAdminConfigUpdated'
        ],
        // Message Events
        'App\Events\Message\ChatRoomCreated' => [
            'App\Listeners\Message\NotifyChatRoomCreated'
        ],
        // Auth Events
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],

    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
