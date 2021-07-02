<?php

namespace App\Providers;

use Carbon\Carbon;
use Laravel\Passport\Passport;
use Illuminate\Support\Facades\Gate;
use Mockery\Generator\StringManipulation\Pass\Pass;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        \App\Models\Category::class => \App\Policies\CategoryPolicy::class, // ok
        \App\Models\CategoryGroup::class => \App\Policies\CategoryGroupPolicy::class, // ok
        \App\Models\CategorySubGroup::class => \App\Policies\CategorySubGroupPolicy::class, // ok
        \App\Models\Config::class => \App\Policies\ConfigPolicy::class,
        \App\Models\Coupon::class => \App\Policies\CouponPolicy::class,
        \App\Models\Customer::class => \App\Policies\CustomerPolicy::class, // ok
        \App\Models\Country::class => \App\Policies\CountryPolicy::class,
        \App\Models\Currency::class => \App\Policies\CurrencyPolicy::class,
        \App\Models\GiftCard::class => \App\Policies\GiftCardPolicy::class,
        \App\Models\Inventory::class => \App\Policies\InventoryPolicy::class, // ok
        \App\Models\Manufacturer::class => \App\Policies\ManufacturerPolicy::class,
        \App\Models\Merchant::class => \App\Policies\MerchantPolicy::class, // ok
        \App\Models\Message::class => \App\Policies\MessagePolicy::class,
        \App\Models\Order::class => \App\Policies\OrderPolicy::class,
        \App\Models\Packaging::class => \App\Policies\PackagingPolicy::class,
        \App\Models\Permission::class => \App\Policies\PermissionPolicy::class, // ok
        \App\Models\Product::class => \App\Policies\ProductPolicy::class, // ok
        \App\Models\Role::class => \App\Policies\RolePolicy::class, // ok
        \App\Models\Shop::class => \App\Policies\ShopPolicy::class, // ok
        \App\Models\ShippingRate::class => \App\Policies\ShippingRatePolicy::class,
        \App\Models\ShippingZone::class => \App\Policies\ShippingZonePolicy::class,
        \App\Models\System::class => \App\Policies\SystemPolicy::class,
        \App\User::class => \App\Policies\UserPolicy::class // ok
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Passport::routes();
        Passport::tokensExpireIn(Carbon::now()->addDays(15));
        Passport::refreshTokensExpireIn(Carbon::now()->addDays(30));
    }
}
