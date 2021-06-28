<?php

namespace App\Models;

use App\Common\Imageable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Banner extends BaseModel
{
    use SoftDeletes, Imageable;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'banners';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'description',
        'link',
        'link_label',
        'bg_color',
        'group_id',
        'columns',
        'order'
    ];

    /**
     * Get the group for the banner.
     */
    public function group()
    {
        return $this->belongsTo(BannerGroup::class);
    }

    /**
     * Setters.
     */
    public function setOrderAttribute($value)
    {
        $this->attributes['order'] = $value ?: 100;
    }
}