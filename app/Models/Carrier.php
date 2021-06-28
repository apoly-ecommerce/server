<?php

namespace App\Models;

use App\Common\Imageable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Carrier extends BaseModel
{
    use SoftDeletes, Imageable;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'carriers';

    /**
     * The attributes that should be casted to boolean types.
     *
     * @var array
     */
    protected $cast = ['active' => 'boolean'];

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
        'tax_id',
        'name',
        'email',
        'phone',
        'tracking_id',
        'active'
     ];
}
