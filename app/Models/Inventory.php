<?php

namespace App\Models;

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
        'brand',
        'supplier_id',
        'sku',
        'condition',
        'condition_note',
        'description',
        'key_features',
        'stock_quantity',
        'damaged_quantity',
        'user_id',
        'purchase_price',
        'sale_price',
        'offer_price',
        'shipping_weight',
        'free_shipping',
        'min_order_quantity',
        'slug',
        'linked_items',
        'meta_title',
        'meta_description',
        'stuff_pick',
        'active'
    ];
}
