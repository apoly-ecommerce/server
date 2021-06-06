<?php

namespace App\Models;

use App\Common\Addressable;
use App\Common\Imageable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Shop extends Model
{
    use SoftDeletes, Addressable, Imageable;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'shops';

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at', 'trial_ends_at'];

    /**
     * The attributes casts to native types.
     *
     * @var array
     */
    protected $casts = [
        'active' => 'boolean',
        'hide_trial_notice' => 'boolean',
        'payment_verified' => 'boolean',
        'is_verified' => 'boolean',
        'phone_verified' => 'boolean',
        'address_verified' => 'boolean'
    ];

    /**
     * The name that will be ignored when log this model.
     *
     * @var array
     */
    protected static $ignoreChangeAttributes = [
        'stripe_id',
        'card_brand',
        'card_holder_name',
        'hide_trial_notice',
        'update_at'
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'owner_id',
        'name',
        'legal_name',
        'email',
        'slug',
        'description',
        'external_url',
        'timezone_id',
        'current_billing_plan',
        'stripe_id',
        'card_holder_name',
        'card_brand',
        'card_last_four',
        'trial_ends_at',
        'hide_trial_notice',
        'active',
        'payment_verified',
        'id_verified',
        'phone_verified',
        'address_verified',
    ];

    /**
     * Get the user owns the shop.
     */
    public function owner()
    {
        return $this->belongsTo(\App\User::class, 'owner_id')->withTrashed();
    }

    /**
     * Get the staff for the shop.
     */
    public function staffs()
    {
        return $this->hasMany(\App\User::class)->withTrashed();
    }

}