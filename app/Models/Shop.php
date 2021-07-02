<?php

namespace App\Models;

use App\Common\Addressable;
use App\Common\Imageable;
use App\Common\Feedbackable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Shop extends BaseModel
{
    use SoftDeletes, Addressable, Imageable, Feedbackable;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'shops';

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at', 'trial_ends_at'];

    /**
     * The attributes casts to native types.
     *
     * @var array
     */
    protected $casts = [
        'active' => 'boolean',
        'is_subscribed' => 'boolean',
        'phone_verified' => 'boolean',
        'address_verified' => 'boolean'
    ];

    /**
     * The name that will be ignored when log this model.
     *
     * @var array
     */
    protected static $ignoreChangeAttributes = [
        'stripe_id',
        'card_brand',
        'card_holder_name',
        'hide_trial_notice',
        'update_at'
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'owner_id',
        'name',
        'legal_name',
        'email',
        'slug',
        'description',
        'external_url',
        'active',
        'is_subscribed',
        'phone_verified',
        'address_verified',
    ];

    /**
     * Get the user owns the shop.
     */
    public function owner()
    {
        return $this->belongsTo(\App\User::class, 'owner_id')->withTrashed();
    }

    /**
     * Get the staff for the shop.
     */
    public function staffs()
    {
        return $this->hasMany(\App\User::class)->withTrashed();
    }

    /**
     * Get the config for the shop.
     */
    public function config()
    {
        return $this->hasOne(Config::class);
    }

    /**
     * Get the ShippingZones for the shop.
     */
    public function shippingZones()
    {
        return $this->hasMany(ShippingZone::class);
    }

    /**
     * Get the address for the shop.
     */
    public function address()
    {
        return $this->hasOne(Address::class, 'addressable');
    }

    /**
     * Get the products for the shop.
     */
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    /**
     * Get the orders for the shop.
     */
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    /**
     * Get the carts for the shop.
     */
    public function carts()
    {
        return $this->hasMany(Cart::class);
    }

    /**
     * Check if the vendor can create listing using this product.
     *
     * @return boolean
     */
    public function canAddThisInventory($product)
    {
        if (! $product instanceof Product) {
            $product = Product::select('shop_id')->where('id', $product)->first();
        }

        if (! $product) {
            return false;
        }

        return $product->shop_id == $this->id;
    }

}