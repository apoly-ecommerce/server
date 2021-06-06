<?php

namespace App\Models;

class Module extends BaseModel
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'modules';

    /**
     * The 'booting' method of the model.
     *
     * @return void
     */
    public static function boot()
    {
        parent::boot();
    }

    /**
     * Get the permissions for the shop.
     *
     */
    public function permissions()
    {
        return $this->hasMany(Permission::class);
    }

}