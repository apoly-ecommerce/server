<?php

namespace App\Models;

class Refund extends BaseModel
{
    const STATUS_NEW      = 1;
    const STATUS_APPROVED = 2;
    const STATUS_DECLINED = 3;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'refunds';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'shop_id',
        'order_id',
        'order_fulfilled',
        'return_goods',
        'amount',
        'description',
        'status'
    ];
}
