<?php

namespace App\Models;

use App\Common\Imageable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Slider extends BaseModel
{
    use SoftDeletes, Imageable;

    /**
     * The database table used by the Slider
     *
     * @var string
     */
    protected $table = 'sliders';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'sub_title',
        'title_color',
        'sub_title_color',
        'description',
        'description_color',
        'alt_color',
        'text_position',
        'link',
        'order',
    ];

    /**
     * Setters
     */
    public function setOrderAttribute($value)
    {
        $this->attributes['order'] = $value ?: 100;
    }

    /**
     * Scope a query to only include mobile slider.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeMobile($query)
    {
        return $query->where('type', 'mobile_slider');
    }
}