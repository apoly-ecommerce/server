<?php

namespace App\Models;

use App\User;
use App\Common\Imageable;

class Group extends BaseModel
{
    use Imageable;

    /**
     * The database table used be the model.
     *
     * @var string
     */
    protected $table = 'groups';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'creator_id',
        'name',
        'active',
        'description'
    ];

    /**
     * Get the users for the room.
     */
    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    /**
     * That attributes that should be casted to boolean types.
     *
     * @var array
     */
    protected $casts = ['active' => 'boolean'];

    /**
     * The the user creator the group.
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'creator_id');
    }
}