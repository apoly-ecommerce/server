<?php

namespace App\Repositories\Country;

use App\Models\Country;
use App\Repositories\BaseRepository;
use App\Repositories\EloquentRepository;

class EloquentCountry extends EloquentRepository implements BaseRepository, CountryRepository
{
    protected $model;

    public function __construct(Country $country)
    {
        $this->model = $country;
    }

    public function all()
    {
        return $this->model->with('currency:id,name', 'timezone:id,value')->withCount('states')->get();
    }
}