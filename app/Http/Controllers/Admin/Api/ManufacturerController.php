<?php

namespace App\Http\Controllers\Admin\Api;

use App\Common\Authorizable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Validations\CreateManufacturerRequest;
use App\Http\Requests\Validations\UpdateManufacturerRequest;
use App\Http\Resources\ApiStatusResource;
use App\Http\Resources\CountryResource;
use App\Http\Resources\ManufacturerResource;
use App\Models\Country;
use Illuminate\Http\Request;
use App\Repositories\Manufacturer\ManufacturerRepository;

class ManufacturerController extends Controller
{
    use Authorizable;

    protected $model;
    protected $manufacturer;

    /**
     * The construct
     *
     */
    public function __construct(ManufacturerRepository $manufacturer)
    {
        $this->model = trans('app.model.manufacturer');
        $this->manufacturer = $manufacturer;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $manufacturers = $this->manufacturer->all();

        $successRes = [
          'manufacturers' => ManufacturerResource::collection($manufacturers),
          'status' => 200
      ];

      return new ApiStatusResource($successRes);
    }

    /**
     * Return response creating or updating resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function setup()
    {
        $countries = Country::all();

        $successRes = [
            'countries' => CountryResource::collection($countries)
        ];

        return new ApiStatusResource($successRes);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function paginate(Request $request)
    {
        $manufacturers = $this->manufacturer->allWithPaginate($request->limit);

        $successRes = [
            'manufacturers' => ManufacturerResource::collection($manufacturers),
            'total'  => $this->manufacturer->all()->count(),
            'status' => 200
        ];

        return new ApiStatusResource($successRes);
    }

    /**
     * Display a listing trashed of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function trashedPaginate(Request $request)
    {
        $manufacturers = $this->manufacturer->trashOnlyWithPaginate($request->limit);

        $successRes = [
            'manufacturers' => ManufacturerResource::collection($manufacturers),
            'total'  => $this->manufacturer->trashOnly()->count(),
            'status' => 200,
        ];

        return new ApiStatusResource($successRes);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\CreateManufacturerRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateManufacturerRequest $request)
    {
        $manufacturer = $this->manufacturer->store($request);

        $successRes = [
            'success' => trans('messages.created', ['model' => $this->model]),
            'manufacturer' => new ManufacturerResource($manufacturer),
            'status' => 200
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
        $manufacturer = $this->manufacturer->find($id);

        $successRes = [
            'manufacturer' => new ManufacturerResource($manufacturer),
            'status' => 200
        ];

        return new ApiStatusResource($successRes);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\UpdateManufacturerRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateManufacturerRequest $request, $id)
    {
        $this->manufacturer->update($request, $id);

        $successRes = [
            'success' => trans('messages.updated', ['model' => $this->model]),
            'status' => 200
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
        $this->manufacturer->trash($id);

        $successRes = [
            'success' => trans('messages.trashed', ['model' => $this->model]),
            'status'  => 200
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
        $this->manufacturer->massTrash($request->ids);

        $successRes = [
            'success' => trans('messages.trashed', ['model' => $this->model]),
            'status'  => 200
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
        $this->manufacturer->destroy($id);

        $successRes = [
            'success' => trans('messages.deleted', ['model' => $this->model]),
            'status'  => 200
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
        $this->manufacturer->massDestroy($request->ids);

        $successRes = [
            'success' => trans('messages.deleted', ['model' => $this->model]),
            'status'  => 200
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
        $this->manufacturer->restore($id);

        $successRes = [
            'success' => trans('messages.restored', ['model' => $this->model]),
            'status'  => 200
        ];

        return new ApiStatusResource($successRes);
    }

    /**
     * Restore the mass resources.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function massRestore(Request $request)
    {
        $this->manufacturer->massRestore($request->ids);

        $successRes = [
            'success' => trans('messages.restored', ['model' => $this->model]),
            'status'  => 200
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
        $this->manufacturer->emptyTrash();

        $successRes = [
            'success' => trans('messages.deleted', ['model' => $this->model]),
            'status'  => 200
        ];

        return new ApiStatusResource($successRes);
    }
}
