<?php

namespace App\Models;

use Auth;
use App\Scopes\RoleScope;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends BaseModel
{

    use SoftDeletes;

    const SUPER_ADMIN = 1; // Don't change it.
    const ADMIN       = 2; // Don't change it.
    const MERCHANT    = 3; // Don't change it.

    /**
     * The database model used the model.
     *
     * @var string
     */
    protected $table = 'roles';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'shop_id',
        'name',
        'description',
        'public',
        'level'
    ];

    /**
     * The attribute that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        if (Auth::user() && ! Auth::user()->isSuperAdmin()) {
            static::addGlobalScope(new RoleScope);
        }
    }

    /**
     * Get all the user for the role.
     */
    public function users()
    {
        return $this->hasMany(\App\User::class);
    }

    /**
     * Get all the permissions for the role.
     */
    public function permissions()
    {
        return $this->belongsToMany(Permission::class)->withTimestamps();
    }

    /**
     * Check if the role is the Super Admin.
     *
     * @return bool
     */
    public function isSuperAdmin()
    {
        return $this->id == static::SUPER_ADMIN;
    }

    /**
     * Check if the role is a special kind.
     *
     * @return bool
     */
    public function isSpecial()
    {
        return $this->id <= static::MERCHANT;
    }

    /**
     * Scope a query to only include records from the users shop.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */

    public function scopeLowerPrivileged($query)
    {
        if (Auth::user()->isFromPlatform()){
            if (Auth::user()->role->level) {
                return $query->whereNull('level')->orWhere('level', '>', Auth::user()->role->level);
            }

            return $query->whereNull('level');
        }

        if (Auth::user()->role->level) {
            return $query->where('shop_id', Auth::user()->merchantId())->whereNull('level')->orWhere('level', '>', Auth::user()->role->level);
        }

        return $query->where('shop_id', Auth::user()->merchantId())->whereNull('level');

    }

    /**
     * Scope a query to only include public roles.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopePublic($query)
    {
        return $query->where('active', 1)->whereNull('shop_id');
    }

    /**
     * Scope a query to only include non public roles.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeNonPublic($query)
    {
        return $query->where('active', '!=', '1');
    }

}