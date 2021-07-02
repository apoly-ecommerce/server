<?php

namespace App\Http\Controllers\Admin\Api;

use App\Common\Authorizable;
use App\Http\Controllers\Controller;
use App\Http\Resources\ApiStatusResource;
use App\Http\Resources\CountryResource;
use App\Repositories\Country\CountryRepository;
use Illuminate\Http\Request;

class CountryController extends Controller
{

    use Authorizable;

    protected $model;
    protected $country;


    /**
     * Constructor.
     */
    public function __construct(CountryRepository $country)
    {
        $this->model = trans('app.model.country');
        $this->country = $country;
    }

    public function index()
    {
        $countries = $this->country->all();

        $successRes = [
            'countries' => CountryResource::collection($countries),
            'status' => 200
        ];

        return new ApiStatusResource($successRes);
    }

}
