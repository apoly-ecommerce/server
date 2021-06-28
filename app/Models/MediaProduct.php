<?php

namespace App\Models;

class MediaProduct extends BaseModel
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'media_products';

    /**
     * The attribute that are mass assignable.
     *
     * @var string
     */
    protected $fillable = [
        'type',
        'url',
        'product_id',
    ];

    /**
     * Get the product for the mediaProduct
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
