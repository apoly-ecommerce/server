<?php

namespace App\Http\Controllers\Admin\Api;

use App\Common\Authorizable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Validations\CreateProductRequest;
use App\Http\Requests\Validations\UpdateProductRequest;
use App\Http\Resources\ApiStatusResource;
use App\Http\Resources\ProductResource;
use App\Repositories\Product\ProductRepository;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    use Authorizable;

    protected $model;
    protected $product;

    /**
     * Constructor.
     */
    public function __construct(ProductRepository $product)
    {
        $this->model = trans('app.model.product');
        $this->product = $product;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = $this->product->all();

        $successRes = [
            'products' => ProductResource::collection($products),
        ];

        return new ApiStatusResource($successRes);
    }

    /**
     * Display a listing trashed of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function paginate(Request $request)
    {
        $products = $this->product->allWithPaginate($request->limit);

        $successRes = [
            'products' => ProductResource::collection($products),
            'total'  => $this->product->all()->count(),
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
        $products = $this->product->trashOnlyWithPaginate($request->limit);

        $successRes = [
            'products' => ProductResource::collection($products),
            'total'  => $this->product->trashOnly()->count(),
        ];

        return new ApiStatusResource($successRes);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\CreateProductRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateProductRequest $request)
    {
        $this->product->store($request);

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
        $product = $this->product->find($id);

        $successRes = [
            'product' => new ProductResource($product),
        ];

        return new ApiStatusResource($successRes);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\UpdateProductRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductRequest $request, $id)
    {
        $this->product->update($request, $id);

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
        $this->product->trash($id);

        $successRes = [
            'success' => trans('messages.trashed', ['model' => $this->model]),
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
        $this->product->massTrash($request->ids);

        $successRes = [
            'success' => trans('messages.trashed', ['model' => $this->model]),
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
        $this->product->destroy($id);

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
        $this->product->massDestroy($request->ids);

        $successRes = [
            'success' => trans('messages.deleted', ['model' => $this->model]),
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
        $this->product->restore($id);

        $successRes = [
            'success' => trans('messages.restored', ['model' => $this->model]),
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
        $this->product->massRestore($request->ids);

        $successRes = [
            'success' => trans('messages.restored', ['model' => $this->model]),
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
        $this->product->emptyTrash();

        $successRes = [
            'success' => trans('messages.deleted', ['model' => $this->model]),
        ];

        return new ApiStatusResource($successRes);
    }

}
