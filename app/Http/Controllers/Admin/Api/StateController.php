<?php

namespace App\Http\Controllers\Admin\Api;

use App\Common\Authorizable;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StateController extends Controller
{
    use Authorizable;

    protected $model;
    protected $state;

    /**
     * Construct
     */

    public function __construct()
    {

    }

    public function byCountry($id)
    {

    }

}
