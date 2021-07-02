<?php

namespace App\Models;

use App\Common\Imageable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends BaseModel
{

    use SoftDeletes, Imageable;
    /**
     * The database table used by the model.
     *
     * @var array
     */
    protected $table = 'products';

    /**
     * Cascade SoftDeletes Relationships.
     *
     * @var string
     */
    protected $cascadeDeletes = ['inventories'];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'shop_id',
        'manufacturer_id',
        'brand',
        'name',
        'model_number',
        'mpn',
        'detail_information',
        'description',
        'promotional_price',
        'original_price',
        'requires_shipping',
        'slug',
        'meta_title',
        'meta_description',
        'sale_count',
        'active',
        'warranty_period',
        'warranty_form',
        'warranty_place',
        'percent_refund',
        'return_time',
        'allow_inspection'
    ];

    /**
     * The attributes that should be casted to boolean types.
     *
     * @var array
     */
    protected $cats = ['active', 'requires_shipping', 'allow_inspection'];

    /**
     * Get the manufacturer associated with the product.
     */
    public function manufacturer()
    {
        return $this->belongsTo(Manufacturer::class);
    }

    /**
     * Get the shop associated with the product.
     */
    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }

    /**
     * Get the categories for the product
     */
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    /**
     * Get the Inventory for the Product.
     */
    public function inventories()
    {
        return $this->hasMany(Inventory::class);
    }

    /**
     * Get all media products for the product
     */
    public function mediaProducts()
    {
        return $this->hasMany(MediaProduct::class);
    }
}