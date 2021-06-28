<?php

namespace App\Models;

class BannerGroup extends BaseModel
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'banner_groups';

    /**
     * The primary key is not incrementing
     *
     * @var boolean
     */
    public $incrementing = false;

    /**
     * The attributes the are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name'
    ];

    /**
     * Get all banner banner for the group.
     */
    public function banners()
    {
        return $this->hasMany(Banner::class, 'group_id');
    }
}
