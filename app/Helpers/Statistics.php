<?php

namespace App\Helpers;

use App\Models\Order;

/**
 * Provide statistics all over the application.
 */
class Statistics
{
    public static function total_spent($customer_id)
    {
        return Order::withTrashed()->where('customer_id', $customer_id)->sum('total');
    }
}