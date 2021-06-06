<?php

namespace App;


use App\Models\Role;
use App\Common\Imageable;
use App\Common\Addressable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable, SoftDeletes, Imageable, Addressable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'host_id',
        'role_id',
        'name',
        'nice_name',
        'email',
        'phone',
        'password',
        'active',
        'dob',
        'sex',
        'description',
        'last_visited_at',
        'last_visited_from',
        'read_announcements_at',
        'verification_token',
        'email_verified_at',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'verification_token'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'dob' => 'date',
        'deleted_at' => 'datetime',
        'last_visited_at' => 'datetime',
        'read_announcements_at' => 'datetime',
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get the country for the Address.
     */
    public function country()
    {
        return $this->hasManyThrough(Country::class, Address::class, 'addressable_id', 'country_name');
    }

    /**
     * Get the role for the user.
     */
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    /**
     * Get the merchant id for the user.
     *
     * @return int
     */
    public function merchantId() : int
    {
        return (int) $this->shop_id;
    }

    /**
     * Check if the user is the Super Admin
     *
     * @return bool
     */
    public function isSuperAdmin() : bool
    {
        return $this->role_id == \App\Models\Role::SUPER_ADMIN;
    }

    /**
     * Check if the user is the Super Admin or Admin.
     *
     * @return bool
     */
    public function isAdmin() : bool
    {
        return $this->isSuperAdmin() || $this->role_id == \App\Models\Role::ADMIN;
    }

    /**
     * Check if the user is a Merchant.
     *
     * @return bool
     */
    public function isMerchant()
    {
        return $this->role_id == \App\Models\Role::MERCHANT;
        // return 'hello';
        // return $this->role_id;
        // return \App\Models\Role::MERCHANT;
    }

    /**
     * Check if the user is from a Merchant or not.
     *
     * @return bool
     */
    public function isFromMerchant() : bool
    {
        return $this->isMerchant() || $this->merchantId();
    }

    /**
     * Check if the user is from main platform or not.
     *
     * @return bool
     */
    public function isFromPlatform()
    {
        return ! $this->isMerchant() && ! $this->merchantId();
    }

    /**
     * Check if access level the user.
     *
     * @return bool
     */
    public function accessLevel()
    {
        return $this->role->level ? $this->role->level + 1 : null;
    }

    /**
     * Scope a query to only include records not Super admin.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeNotSuperAdmin($query)
    {
        return $query->where('role_id', '!=', Role::SUPER_ADMIN);
    }

    /**
     * Scope a query to only include records from the users shop.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeFromPlatform($query)
    {
        return $query->where('role_id', '!=', Role::MERCHANT)->where('shop_id', null);
    }

    /**
     * Scope a query to only include records from the user shop.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeMerchant($query)
    {
        return $query->where('role_id', Role::MERCHANT);
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
     * Check the user is subscribed.
     *
     * @return bool
     */
    public function isSubscribed() : bool
    {
        if ($this->isFromPlatform() || ! $this->merchantId()) {
            return false;
        }

        $subscription = optional($this->shop->subscriptions)->first();

        return $subscription && $subscription->valid() || $this->isOnGenericTrial();
    }

    /**
     * Check if the user is isOnGenericTrial without card.
     *
     * @return bool
     */
    public function isOnGenericTrial() : bool
    {
        return $this->shop->onGenericTrial();
    }

}