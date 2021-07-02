<?php

namespace App\Models;

use Carbon\Carbon;
use App\Common\Imageable;
use App\Common\Taggable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Inventory extends BaseModel
{
    use SoftDeletes, Imageable, Taggable;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'inventories';

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at', 'offer_start', 'offer_end', 'available_from'];

    /**
     * The attributes that should be casted to boolean types.
     *
     * @var array
     */
    protected $casts = [
        'free_shipping' => 'boolean',
        'stuff_pick' => 'boolean',
        'active' => 'boolean',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'shop_id',
        'title',
        'product_id',
        'sku',
        'condition',
        'condition_note',
        'description',
        'stock_quantity',
        'user_id',
        'purchase_price',
        'sale_price',
        'offer_price',
        'min_order_quantity',
        'slug',
        'linked_items',
        'meta_title',
        'meta_description',
        'active'
    ];

    /**
     * Get the shop of the inventory.
     */
    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }

    /**
     * Get the product of the inventory.
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Get the carts for the product.
     */
    public function carts()
    {
        return $this->belongsToMany(Order::class, 'cart_items')
        ->withPivot('item_description', 'quantity', 'unit_price')->withTimestamps();
    }

    /**
     * Get the orders for the product.
     */
    public function orders()
    {
        return $this->belongsToMany(Order::class, 'order_items')
        ->withPivot('item_description', 'quantity', 'unit_price')->withTimestamps();
    }

    /**
     * Get the manufacturer associated with the product.
     */
    public function getManufacturerAttribute()
    {
        return $this->product->manufacturer;
    }

    /**
     * Check if the item has a valid offer price.
     */
    public function hasOfferPrice()
    {
        if (
            ($this->offer_price > 0) &&
            ($this->offer_price < $this->sale_price) &&
            ($this->offer_start < Carbon::Now()) &&
            ($this->offer_end > Carbon::Now())
        ) {
            return true;
        }

        return false;
    }

    /**
     * Return current sale price.
     */
    public function current_sale_price()
    {
        return $this->hasOfferPrice() ? $this->offer_price : $this->sale_price;
    }

    /**
     * Return this discount percentage.
     *
     * @return number
     */
    public function discount_percentage()
    {
        return $this->hasOfferPrice() ? get_percentage($this->sale_price, $this->offer_price) : 0;
    }

    /**
     * Setters
     */
    public function setMinOrderQuantityAttribute($value)
    {
        $this->attributes['min_order_quantity'] = $value > 1 ? $value : 1;
    }

    public function setOfferPriceAttribute($value)
    {
        $this->attributes['offer_price'] = $value > 1 ? $value : null;
    }

    public function setAvailableFromAttribute($value)
    {
        if ($value) {
            $this->attributes['available_from'] = Carbon::createFromFormat('Y-m-d h:i a', $value);
        }
    }

    public function setOfferStartAttribute($value)
    {
        if ($value) {
            $this->attributes['offer_start'] = Carbon::createFromFormat('Y-m-d h:i a', $value);
        }
    }

    public function setOfferEndAttribute($value)
    {
        if ($value) {
            $this->attributes['offer_end'] = Carbon::createFromFormat('Y-m-d h:i a', $value);
        }
    }

    public function setLinkedItemsAttribute($value)
    {
        $this->attributes['linked_items'] = (bool) $value ? serialize($value) : null;
    }

    /**
     * Scope a query to only include available for sale.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeAvailable($query)
    {
        return $query->whereHas('shop', function ($q) {
            $q->active();
        })->where([
            ['active' => 1],
            ['stock_quantity', '>', 0],
            ['available_from', '<=', Carbon::now()]
        ]);
    }

    /**
     * Scope a query to only include available for sale.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeHasOfferPrice($query)
    {
        return $query->where([
            ['offer_price', '>', 0],
            ['offer_start', '<', Carbon::Now()],
            ['offer_end', '>', Carbon::Now()]
        ])->whereColumn('offer_price', '<', 'sale_price');
    }

}