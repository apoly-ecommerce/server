<?php

namespace App\Models;

class Tag extends BaseModel
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tags';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name'];

    /**
     * Get all of the customer that are assigned this tag.
     */
    public function customers()
    {
        return $this->morphedByMany(App\Model\Customer::class, 'taggable');
    }

    /**
     * Get all of the shope that are assigned this tag.
     */
    public function shops()
    {
        return $this->morphedByMany(App\Model\Shop::class, 'taggable');
    }

    /**
     * Get all of the products that are assigned this tag.
     */
    public function products()
    {
        return $this->morphedByMany(App\Model\Product::class, 'taggable');
    }

    /**
     * Get all of the manufacturer products that are assigned this tag.
     */
    public function manufacturer()
    {
        return $this->morphedByMany(App\Model\Manufacturer::class, 'taggable');
    }
}
