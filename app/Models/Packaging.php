<?php

namespace App\Models;

use App\Common\Imageable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Packaging extends BaseModel
{
    use SoftDeletes, Imageable;

    const FREE_PACKAGING_ID = 1;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'packagings';

    /**
     * The attributes that should be casted to boolean types.
     *
     * @var array
     */
    protected $casts = [
        'default' => 'boolean',
        'active' => 'boolean',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'shop_id',
        'name',
        'cost',
        'height',
        'width',
        'depth',
        'default',
        'active',
     ];
}
