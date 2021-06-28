<?php

namespace App\Models;

use App\Common\Imageable;
use Illuminate\Database\Eloquent\SoftDeletes;

class GiftCard extends BaseModel
{
    use SoftDeletes, Imageable;

    /**
     * The database table used to the model.
     */
    protected $table = 'gift_cards';

    /**
     * The attributes that should be casted to boolean types.
     *
     * @var array
     */
    protected $cast = [
        'partial_use' => 'boolean',
        'exclude_offer_items' => 'boolean',
        'exclude_tax_n_shipping' => 'boolean',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'activation_time',
        'expiry_time',
        'deleted_at'
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'customer_id',
        'name',
        'description',
        'serial_number',
        'pin_code',
        'value',
        'remaining_value',
        'partial_use',
        'activation_time',
        'expiry_time',
        'exclude_offer_items',
        'exclude_tax_n_shipping'
    ];
}
