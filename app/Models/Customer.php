<?php

namespace App\Models;

use Hash;
use App\Common\Addressable;
use App\Common\Imageable;
use App\Common\Taggable;
use App\Common\Attachable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class Customer extends BaseModel
{
    use SoftDeletes, Imageable, Addressable, Notifiable, Taggable, Attachable, HasApiTokens;

    private $limit_lasted_order = 5;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'customers';

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'verification_token'
    ];

    /**
     * The attributes that should be mutated to dates.
     */
    protected $dates = [
        'deleted_at',
        'last_visited_at'
    ];

    /**
     * The attributes that should be casted to boolean types.
     *
     * @var array
     */
    protected $casts = [
        'dob' => 'date',
        'active' => 'boolean',
        'accepts_marketing' => 'boolean'
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'nice_name',
        'email',
        'password',
        'dob',
        'sex',
        'description',
        'last_visited_at',
        'last_visited_from',
        'card_holder_name',
        'card_brand',
        'card_last_four',
        'active',
        'accepts_marketing',
        'verification_token',
    ];

    /**
     * Route notifications for the mail channel.
     *
     * @return string
     */
    public function routeNotificationForMail()
    {
        return $this->email;
    }

    /**
     * Get all of the country for the customer.
     */
    public function country()
    {
        return $this->hasManyThrough(Country::class, Address::class, 'addressable_id', 'country_name');
    }

    /**
     * Get the user orders.
     */
    public function orders()
    {
        return $this->hasMany(Order::class)->orderBy('created_at', 'desc');
    }

    public function latest_orders()
    {
        return $this->orders()->orderBy('created_at', 'desc')->limit($this->limit_lasted_order);
    }

    /**
     * Get the user carts.
     */
    public function carts()
    {
        return $this->hasMany(Cart::class);
    }

    /**
     * Get the messages for the customer.
     */
    public function messages()
    {
        return $this->hasMany(Message::class)->notArchived()
        ->orderBy('customer_status')->orderBy('updated_at', 'desc');
    }

    /**
     * Get the coupons for the customer
     */
    public function coupons()
    {
        return $this->belongsToMany(Coupon::class)->active()
        ->orderBy('ending_mine', 'desc');
    }

    /**
     * Get all of the refunds for the customer.
     */
    public function refunds()
    {
        return $this->hasManyThrough(Refund::class, Order::class);
    }

    /**
     * Get the user gift_cards.
     */
    public function gift_cards()
    {
        return $this->hasMany(GiftCard::class);
    }

    /**
     *  Get name the user.
     */
    public function getName()
    {
        return $this->nice_name ?: $this->name;
    }

    /**
     * Check if the user is Verified
     *
     * @return bool
     */
    public function isVerified()
    {
        return $this->verification_token == Null;
    }

    /**
     * Setters.
     */
    public function setPasswordAttribute($password)
    {
        return $this->attributes['password'] = Hash::needsRehash($password) ? bcrypt($password) : $password;
    }

    public function setAcceptsMarketingAttribute($value)
    {
        return $this->attributes['accepts_marketing'] = $value ? 1 : null;
    }

    /**
     * Send the password reset notification.
     *
     * @param string $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        // $this->notify();
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

}
