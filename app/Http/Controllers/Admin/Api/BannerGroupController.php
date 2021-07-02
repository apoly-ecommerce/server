<?php

namespace App\Http\Controllers\Admin\Api;

use App\Common\Authorizable;
use App\Http\Controllers\Controller;
use App\Http\Resources\ApiStatusResource;
use App\Repositories\BannerGroup\BannerGroupRepository;
use Illuminate\Http\Request;

class BannerGroupController extends Controller
{
    use Authorizable;

    protected $model;
    protected $bannerGroup;

    /**
     * Constructor
     */
    public function __construct(BannerGroupRepository $bannerGroup)
    {
        $this->model = trans('app.model.bannerGroup');
        $this->bannerGroup = $bannerGroup;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bannerGroups = $this->bannerGroup->all();

        $successRes = [
            'bannerGroups' => $bannerGroups
        ];

        return new ApiStatusResource($successRes);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
