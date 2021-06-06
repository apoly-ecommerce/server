<?php

namespace App\Models;

use App\Common\Imageable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Manufacturer extends BaseModel
{
    use SoftDeletes, Imageable;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'manufacturers';

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
        'name',
        'slug',
        'email',
        'url',
        'phone',
        'description',
        'country_id',
        'active'
    ];

    /**
     * Get the products for the manufacturer.
     */
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

}
