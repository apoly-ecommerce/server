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
        'description',
        'min_price',
        'max_price',
        'origin_country',
        'requires_shipping',
        'slug',
        'meta_title',
        'meta_description',
        'sale_count',
        'active'
    ];

    /**
     * Get the manufacturer associated with the product.
     */
    public function manufacturer()
    {
        return $this->belongsTo(Manufacturer::class);
    }

    /**
     * Get the categories for the product
     */
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
}
