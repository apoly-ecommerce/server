<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class Coupon extends BaseModel
{
    use SoftDeletes;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'coupons';

    /**
     * The attributes that should be casted to boolean types.
     *
     * @var array
     */
    protected $cast = ['active' => 'boolean'];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'starting_time',
        'ending_time',
        'deleted_at'
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'shop_id',
        'name',
        'code',
        'description',
        'value',
        'min_order_amount',
        'type',
        'quantity',
        'quantity_per_customer',
        'starting_time',
        'ending_time',
        'active'
    ];
}