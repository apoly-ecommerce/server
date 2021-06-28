<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class OrderItem extends Pivot
{
    /**
     * The database table used by the model
     *
     * @var string
     */
    protected $table = 'order_items';
}