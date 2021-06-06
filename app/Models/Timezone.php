<?php

namespace App\Models;

class Timezone extends BaseModel
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'timezones';

    /**
     * Get all the countries for the timezone.
     */
    public function countries()
    {
        return $this->hasMany(Country::class);
    }
}