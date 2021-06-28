<?php

namespace App\Models;

class Cancellation extends BaseModel
{
    const STATUS_NEW       = 1; // default
    const STATUS_OPEN      = 2;
    const STATUS_APPROVED  = 3;
    const STATUS_DELIVERED = 4;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'cancellations';

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * The attributes that should be casted to boolean types.
     *
     * @var array
     */
    protected $casts = [
        'return_goods' => 'boolean',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'shop_id',
        'cancellation_reason_id',
        'customer_id',
        'order_id',
        'items',
        'description',
        'return_goods',
        'status'
    ];
}
