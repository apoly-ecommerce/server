<?php

namespace App\Http\Controllers\Admin\Api;

use App\Common\Authorizable;
use App\Events\Shop\ShopUpdated;
use App\Events\Shop\ShopDeleted;
use App\Http\Resources\ShopResource;
use App\Http\Resources\ApiStatusResource;
use App\Http\Controllers\Controller;
use App\Http\Requests\Validations\UpdateShopRequest;
use App\Repositories\Shop\ShopRepository;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    use Authorizable;

    protected $model;
    protected $shop;

    /**
     * Constructor
     *
     * @param ShopRepository $shop
     */
    public function __construct(ShopRepository $shop)
    {
        $this->model = trans('app.model.shop');
        $this->shop = $shop;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function paginate(Request $request)
    {
        $shops = $this->shop->allWithPaginate($request->limit);

        $successRes = [
            'shops' => ShopResource::collection($shops),
            'total'  => $this->shop->all()->count(),
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
        $shops = $this->shop->trashOnlyWithPaginate($request->limit);

        $successRes = [
            'shops' => ShopResource::collection($shops),
            'total'  => $this->shop->trashOnly()->count(),
        ];

        return new ApiStatusResource($successRes);
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @param Shop $shop
     * @return \Illuminate\Http\Response
     */
    public function staffsPaginate(Request $request, $id)
    {
        $shop = $this->shop->find($id);

        $staffs = $this->shop->staffsPaginate($shop, $request->limit);

        $successRes = [
            'staffs' => $staffs,
            'total'  => $this->shop->staffs($shop)->count()
        ];

        return new ApiStatusResource($successRes);
    }

    /**
     *
     */
    public function staffTrashOnlyPaginate(Request $request, $id)
    {
        $shop = $this->shop->find($id);

        $staffs = $this->shop->staffTrashOnlyPaginate($shop, $request->limit);

        $successRes = [
            'staffs' => $staffs,
            'total' => $this->shop->staffTrashOnly($shop)->count(),
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
        $shop = $this->shop->find($id);

        $successRes = [
            'shop' => new ShopResource($shop)
        ];

        return new ApiStatusResource($successRes);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\Validations\UpdateShopRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateShopRequest $request, $id)
    {
        $shop = $this->shop->update($request, $id);

        // Trigger Shop updated
        event(new ShopUpdated($shop));

        $successRes = [
            'success' => trans('messages.updated', ['model' => $this->model])
        ];

        return new ApiStatusResource($successRes);
        return $id;
    }

    /**
     * Trash the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function trash($id)
    {
        $this->shop->trash($id);

        // Trigger Shop deleted
        event(new ShopDeleted($id));

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
        $this->shop->restore($id);

        $successRes = [
            'success' => trans('messages.restored', ['model' => $this->model]),
        ];

        return new ApiStatusResource($successRes);
    }

    /**
     * Restore the specified resource from storage.
     */
    public function massRestore(Request $request)
    {
        $this->shop->massRestore($request->ids);

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
      $this->shop->destroy($id);

      $successRes = [
          'success' => trans('messages.deleted', ['model' => $this->model]),
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
        $this->shop->massTrash($request->ids);

        $successRes = [
            'success' => trans('messages.trashed', ['model' => $this->model]),
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
        $this->shop->massDestroy($request->ids);

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
        $this->shop->emptyTrash();

        $successRes = [
            'success' => trans('messages.deleted', ['model' => $this->model]),
        ];

        return new ApiStatusResource($successRes);
    }
}
