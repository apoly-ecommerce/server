<?php

namespace App\Http\Controllers\Admin\Api;

use App\Common\Authorizable;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Validations\CreateBannerRequest;
use App\Http\Requests\Validations\UpdateBannerRequest;
use App\Http\Resources\BannerResource;
use App\Http\Resources\ApiStatusResource;
use App\Repositories\Banner\BannerRepository;

class BannerController extends Controller
{

    use Authorizable;

    protected $model;
    protected $banner;

    /**
     * Construct.
     */
    public function __construct(BannerRepository $banner)
    {
        $this->model = trans('app.model.banner');
        $this->banner = $banner;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $banners = $this->banner->all();

        $successRes = [
            'banners' => BannerResource::collection($banners),
        ];

        return new ApiStatusResource($successRes);
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function paginate(Request $request)
    {
        $banners = $this->banner->allWithPaginate($request->limit);

        $successRes = [
            'banners' => BannerResource::collection($banners),
            'total'  => $this->banner->all()->count(),
        ];

        return new ApiStatusResource($successRes);
    }

    /**
     * Display a listing trashed of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function trashedPaginate(Request $request)
    {
        $banners = $this->banner->trashOnlyWithPaginate($request->limit);

        $successRes = [
            'banners' => BannerResource::collection($banners),
            'total'  => $this->banner->trashOnly()->count(),
        ];

        return new ApiStatusResource($successRes);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\Validations\CreateBannerRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateBannerRequest $request)
    {
        $this->banner->store($request);

        $successRes = [
            'success' => trans('messages.created', ['model' => $this->model]),
        ];

        return new ApiStatusResource($successRes);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $banner = $this->banner->find($id);

        $successRes = [
            'banner' => new BannerResource($banner),
        ];

        return new ApiStatusResource($successRes);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\Validations\UpdateBannerRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBannerRequest $request, $id)
    {
        $this->banner->update($request, $id);

        $successRes = [
            'success' => trans('messages.updated', ['model' => $this->model]),
        ];

        return new ApiStatusResource($successRes);
    }

    /**
     * Trash the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function trash($id)
    {
        $this->banner->trash($id);

        $successRes = [
            'success' => trans('messages.trashed', ['model' => $this->model]),
        ];

        return new ApiStatusResource($successRes);
    }

    /**
     * Restore the specified resource from soft delete.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        $this->banner->restore($id);

        $successRes = [
            'success' => trans('messages.restored', ['model' => $this->model]),
        ];

        return new ApiStatusResource($successRes);
    }

    /**
     * Trash the mass resources.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function massTrash(Request $request)
    {
        $this->banner->massTrash($request->ids);

        $successRes = [
            'success' => trans('messages.trashed', ['model' => $this->model]),
        ];

        return new ApiStatusResource($successRes);
    }

    /**
     * Restore the specified resource from storage.
     */
    public function massRestore(Request $request)
    {
        $this->banner->massRestore($request->ids);

        $successRes = [
            'success' => trans('messages.restored', ['model' => $this->model])
        ];

        return new ApiStatusResource($successRes);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->banner->destroy($id);

        $successRes = [
            'success' => trans('messages.deleted', ['model' => $this->model]),
        ];

        return new ApiStatusResource($successRes);
    }

    /**
     * Destroy the mass resources.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function massDestroy(Request $request)
    {
        $this->banner->massDestroy($request->ids);

        $successRes = [
            'success' => trans('messages.deleted', ['model' => $this->model]),
        ];

        return new ApiStatusResource($successRes);
    }

    /**
     * Empty the Trash the mass resources.
     *
     * @return \Illuminate\Http\Response
     */
    public function emptyTrash()
    {
        $this->banner->emptyTrash();

        $successRes = [
            'success' => trans('messages.deleted', ['model' => $this->model]),
        ];

        return new ApiStatusResource($successRes);
    }

}
