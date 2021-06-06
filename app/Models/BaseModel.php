<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Auth;

class BaseModel extends Model
{

    const INACTIVE = 0;
    const ACTIVE   = 1;

    /**
     * Check if the model is active.
     *
     * @return bool
     */
    public function isActive() : bool
    {
        return $this->active == static::ACTIVE;
    }

    /**
     * Scope a query to only include active records.
     *
     * @return Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
        return $query->where('active', 1);
    }

    /**
     * Scope a query to only include records from the users shop.
     *
     * @return Illuminate\Database\Eloquent\Builder
     */
    public function scopeMine($query)
    {
        return $query->where('shop_id', Auth::user()->merchantId());
    }
}