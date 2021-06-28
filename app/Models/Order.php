<?php

namespace App\Models;

use Auth;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends BaseModel
{
    use SoftDeletes;

    const STATUS_WAITING_FOR_PAYMENT    = 1; // default
    const STATUS_PAYMENT_ERROR          = 2;
    const STATUS_CONFIRMED              = 3;
    const STATUS_FULFILLED              = 4; // All status value less than this considered as unfulfilled
    const STATUS_AWAITING_DELIVERY      = 5;
    const STATUS_DELIVERED              = 6;
    const STATUS_RETURNED               = 7;
    const STATUS_CANCELED               = 8;

    const PAYMENT_STATUS_UNPAID             = 1; // Default
    const PAYMENT_STATUS_PENDING            = 2;
    const PAYMENT_STATUS_PAID               = 3; // All status before paid value considered as unpaid
    const PAYMENT_STATUS_INITIATED_REFUND   = 4;
    const PAYMENT_STATUS_PARTIALLY_REFUNDED = 5;
    const PAYMENT_STATUS_REFUNDED           = 6;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'orders';

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['created_at', 'deleted_at', 'shipping_date', 'delivery_date', 'payment_date'];

    /**
     * The attributes that should be casted to boolean types.
     *
     * @var array
     */
    protected $casts = [
        'goods_received' => 'boolean',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'order_number',
        'shop_id',
        'customer_id',
        'ship_to',
        'shipping_zone_id',
        'shipping_rate_id',
        'item_count',
        'quantity',
        'taxrate',
        'shipping_weight',
        'total',
        'discount',
        'shipping',
        'packaging',
        'handling',
        'taxes',
        'grand_total',
        'billing_address',
        'shipping_address',
        'email',
        'shipping_date',
        'delivery_date',
        'tracking_id',
        'coupon_id',
        'carrier_id',
        'payment_status',
        'payment_method_id',
        'order_status_id',
        'message_to_customer',
        'send_invoice_to_customer',
        'admin_note',
        'buyer_note',
        'goods_received',
        'feedback_id'
    ];

    /**
     * Get the country associated with the order.
     */
    public function shipTo()
    {
        return $this->belongsTo(Address::class, 'ship_to');
    }

    /**
     * Get the customer associated with the order.
     */
    public function customer()
    {
        return $this->belongsTo(Customer::class)->withDefault([
            'name' => trans('app.guest_customer')
        ]);
    }

    /**
     * Get the shop associated with the order.
     */
    public function shop()
    {
        return $this->belongsTo(Shop::class)->withDefault();
    }

    /**
     * Get the coupon associated with the order.
     */
    public function coupon()
    {
        return $this->belongsTo(Coupon::class)->withDefault(); // new table ok.
    }

    /**
     * Get the carrier associated with the cart.
     */
    public function carrier()
    {
        return $this->belongsTo(Carrier::class)->withDefault(); // new table ok
    }

    /**
     * Get the items associated with the order.
     */
    public function items()
    {
        return $this->hasMany(orderItem::class, 'order_id');
    }

    /**
     * Get the inventories for the order.
     */
    public function inventories()
    {
        return $this->belongsToMany(Inventory::class, 'order_items')
        ->withPivot(['item_description', 'quantity', 'unit_price', 'feedback_id']);
    }

    /**
     * Return collection of conversation related to the order
     *
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function conversation()
    {
        return $this->hasOne(Message::class, 'order_id'); // new table ok
    }

    /**
     * Return collection of refunds related to the order
     *
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function refunds()
    {
        return $this->hasMany(Refund::class)->orderBy('created_at', 'desc'); // new table ok
    }

    /**
     * Get the cancellation request for the order.
     */
    public function cancellation()
    {
        return $this->hasOne(Cancellation::class); // new table
    }

    /**
     * Get the shippingRate for the order.
     */
    public function shippingRate()
    {
        return $this->belongsTo(ShippingRate::class, 'shipping_rate_id')->withDefault(); // new table ok
    }

    /**
     * Get the shippingZone for the order.
     */
    public function shippingZone()
    {
        return $this->belongsTo(ShippingZone::class, 'shipping_zone_id')->withDefault(); // new table ok
    }

    /**
     * Get the paymentMethod for the user.
     */
    public function paymentMethod()
    {
        return $this->belongsTo(PaymentMethod::class)->withDefault(); // new table
    }

    /**
     * Get the package for the order.
     */
    public function shippingPackage()
    {
        return $this->belongsTo(Packaging::class, 'packaging_id')->withDefault(); // new table
    }

    /**
     * Get the shop feedback for the order.
     */
    public function feedback()
    {
        return $this->belongsTo(Feedback::class, 'feedback_id')->withDefault(); // new table
    }

    /**
     * Set tag date formate
     */
    public function setShippingDateAttribute($value)
    {
        $this->attributes['shipping_date'] = Carbon::createFromFormat('Y-m-d', $value);
    }
    public function setDeliveryDateAttribute($value)
    {
        $this->attributes['delivery_date'] = Carbon::createFromFormat('Y-m-d', $value);
    }
    public function setShippingAddressAttribute($value)
    {
        $this->attributes['shipping_address'] = is_numeric($value) ? \App\Models\Address::find($value)->toString(true) : $value;
    }
    public function setBillingAddressAttribute($value)
    {
        $this->attributes['billing_address'] = is_numeric($value) ? \App\Models\Address::find($value)->toString(true) : $value;
    }

    /**
     * Scope a query to only include records from the users shop.
     *
     * @return Illuminate\Database\Eloquent\Builder
     */
    public function scopeArchived($query)
    {
        return $query->onlyTrashed();
    }

    /**
     * Scope query query to only include records from the users shop.
     *
     * @return Illuminate\Database\Eloquent\Builder
     */
    public function scopeWithArchived($query)
    {
        return $query->withTrashed();
    }

    /**
     * Scope a query to only include records from the users shop.
     *
     * @return Illuminate\Database\Eloquent\Builder
     */
    public function scopeMine($query)
    {
        return $query->where('shop_id', Auth::user()->merchantId());
    }

    /**
     * Scope a query to only include records from the users shop.
     *
     * @return Illuminate\Database\Eloquent\Builder
     */
    public function scopePaid($query)
    {
        return $query->where('payment_status', '>=', static::PAYMENT_STATUS_PAID);
    }

    /**
     * Scope a query to only include records from the users shop.
     *
     * @return Illuminate\Database\Eloquent\Builder
     */
     public function scopeUnPaid($query)
     {
        return $query->where('payment_status', '<', static::PAYMENT_STATUS_PAID);
     }

     /**
      * Scope a query to only include records from the users shop.
      *
      * @return Illuminate\Database\Eloquent\Builder
      */
      public function scopeUnfulfilled($query)
      {
        return $query->where('payment_status', '<', static::STATUS_FULFILLED);
      }

      /**
       * Return shipping cost with handling fee
       *
       * @return number
       */
      public function get_shipping_cost()
      {
          return $this->shipping + $this->handling;
      }

      /**
       * Calculate and return grand total.
       *
       * @return number
       */
      public function calculate_grand_total()
      {
          return ($this->total + $this->handling + $this->taxes + $this->shipping + $this->packaging) - $this->discount;
      }
      public function grand_total_for_paypal()
      {

      }
      public function calculate_total_for_paypal()
      {

      }

      /**
       * Check if the order has been paid.
       *
       * @return boolean
       */
      public function isPaid() : bool
      {
          return $this->payment_status >= static::PAYMENT_STATUS_PAID;
      }

      /**
       * Check if the order as been Fulfilled
       *
       * @return boolean
       */
      public function isFulfilled() : bool
      {
          return $this->order_status_id >= static::STATUS_FULFILLED;
      }

      /**
       * Check if the order as been Delivered
       *
       * @return boolean
       */
      public function isDelivered() : bool
      {
          return $this->order_status_id >= static::STATUS_DELIVERED;
      }

      /**
       * Check if the order as been Canceled.
       *
       * @return boolean
       */
      public function isCanceled() : bool
      {
          return $this->order_status_id >= static::STATUS_CANCELED;
      }

}
