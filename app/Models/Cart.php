<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class Cart extends BaseModel
{
    use SoftDeletes;

    /**
     * The database table used to the model.
     *
     * @var string
     */
    protected $table = 'carts';

    /**
     * The attributes that should be mutated to dates.
     */
    protected $dates = ['deleted_at'];

    /**
     * Load item count with cart.
     *
     * @var array
     */
    protected $withCount = ['inventories'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'shop_id',
        'customer_id',
        'ip_address',
        'ship_to',
        'ship_to_country_id',
        'ship_to_state_id',
        'shipping_zone_id',
        'shipping_rate_id',
        'packaging_id',
        'item_count',
        'quantity',
        'total',
        'discount',
        'shipping',
        'packaging',
        'handling',
        'taxes',
        'grand_total',
        'taxrate',
        'shipping_weight',
        'billing_address',
        'shipping_address',
        'email',
        'coupon_id',
        'payment_status',
        'payment_method_id',
        'message_to_customer',
        'admin_note',
    ];

    /**
     * Get the country associated with the cart.
     */
    public function shipTpo()
    {
        return $this->belongsTo(Address::class, 'shop_id');
    }

    /**
     * Get the country associated with the cart.
     */
    public function country()
    {
        return $this->belongsTo(Country::class, 'ship_to_country_id')->withDefault();
    }

    /**
     * Get the state associated with the cart.
     */
    public function state()
    {
        return $this->belongsTo(State::class, 'ship_to_state_id')->withDefault();
    }

    /**
     * Get the customer associated with the cart.
     */
    public function customer()
    {
        return $this->belongsTo(Customer::class)->withDefault([
            'name' => trans('app.guest_customer')
        ]);
    }

    /**
     * The the shop associated with the cart.
     */
    public function shop()
    {
        return $this->belongsTo(Shop::class)->withDefault();
    }

    /**
     * Get billing address
     *
     * @return Address|null
     */
    public function billingAddress()
    {
        return $this->belongsTo(Address::class, 'billingAddress');
    }

    /**
     * Get shipping address
     *
     * @return Address|null
     */
    public function shippingAddress()
    {
        return $this->belongsTo(Address::class, 'shippingAddress');
    }

    /**
     * Get the shippingZone for the cart.
     */
    public function shippingZone()
    {
        return $this->belongsTo(ShippingZone::class, 'shipping_zone_id');
    }

    /**
     * Get the shippingRate for the cart.
     */
    public function shippingRate()
    {
        return $this->belongsTo(ShippingRate::class, 'shipping_rate_id');
    }

    /**
     * Get the carrier associated with the cart.
     */
    public function carrier()
    {
        return optional($this->shippingRate)->carrier();
    }

    /**
     * Get the coupon associated with the cart.
     */
    public function coupon()
    {
        return $this->belongsTo(Coupon::class);
    }

    /**
     * Get the inventories associated with the cart.
     */
    public function inventories()
    {
        return $this->belongsTo(Inventory::class, 'cart_items')
        ->withPivot('item_description', 'quantity', 'unit_price');
    }

    /**
     * Get the paymentMethod associated with the cart.
     */
    public function paymentMethods()
    {
        return $this->belongsTo(PaymentMethods::class);
    }

    /**
     * Return shipping cost with handling free.
     *
     * @return number
     */
    public function get_shipping_cost()
    {
        return $this->is_free_shipping() ? 0 : $this->shipping + $this->handling;
    }

    /**
     * Return grand total.
     *
     * @return number
     */
    public function grand_total()
    {
        $grand_total = ($this->total + $this->handling + $this->taxes + $this->packaging) - $this->discount;

        return $this->is_free_shipping() ? $grand_total : ($grand_total + $this->shipping);
    }

    /**
     * Check if the cart eligible for free shipping
     *
     * @return boolean
     */
    public function is_free_shipping() : bool
    {
        foreach ($this->inventories as $item) {
            if (! $item->free_shipping) {
                return false;
            }
        }
        return true;
    }

    /**
     * Setters.
     */
    public function setDiscountAttribute($value)
    {
        $this->attributes['discount'] = $value ?? null;
    }
    public function setShippingAddressAttribute($value)
    {
        $this->attributes['shipping_address'] = is_numeric($value) ? $value : null;
    }
    public function setBillingAddressAttribute($value){
        $this->attributes['billing_address'] = is_numeric($value) ? $value : Null;
    }

    public function get_tax_amount()
    {
        return $this->total * ($this->taxrate/100);
    }

    public function getLabelText()
    {
        $txt = '';
        if($this->coupon_id && $this->discount){
            $txt .= trans('app.coupon_applied', ['coupon' => $this->coupon->name]);
        }
        return $txt;
    }

}
