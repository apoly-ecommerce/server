<?php

namespace App\Http\Controllers\Admin\Api;


use Auth;
use App\Common\Authorizable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Validations\CreateInventoryRequest;
use App\Http\Requests\Validations\UpdateInventoryRequest;
use App\Http\Resources\ApiStatusResource;
use App\Http\Resources\InventoryResource;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Repositories\Inventory\InventoryRepository;
use Illuminate\Http\Request;

class InventoryController extends Controller
{

    use Authorizable;

    protected $model;
    protected $inventory;

    /**
     * Constructor
     */
    public function __construct(InventoryRepository $inventory)
    {
        $this->model = trans('app.model.inventory');
        $this->inventory = $inventory;
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
        $inventories = $this->inventory->allWithPaginate($request->limit);

        $successRes = [
            'inventories' => InventoryResource::collection($inventories),
            'total' => $this->inventory->all()->count()
        ];

        return new ApiStatusResource($successRes);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function trashedPaginate(Request $request)
    {
        $inventories = $this->inventory->trashOnlyWithPaginate($request->limit);

        $successRes = [
            'inventories' => InventoryResource::collection($inventories),
            'total'  => $this->inventory->trashOnly()->count()
        ];

        return new ApiStatusResource($successRes);
    }

    /**
     * Return the response for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function add($id)
    {
        $inInventory = $this->inventory->checkInventoryExists($id);
        $product = $this->inventory->findProduct($id);

        if ($inInventory) {
            return redirect()->route('admin.stock.inventory.index');
            // return new ApiStatusResource(['status' => 'created']);
        }

        $successRes = [
            'status' => 'add',
            'product' => new ProductResource($product)
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
        if (Auth::user()->isFromPlatform()) {
            $products = Product::with('categories')->get();
        }
        $products = Product::mine()->with('categories')->get();

        $successRes = [
            'products' => ProductResource::collection($products)
        ];

        return new ApiStatusResource($successRes);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateInventoryRequest $request)
    {
        $this->authorize('create', \App\Models\Inventory::class);

        $this->inventory->store($request);

        $successRes = [
            'success' => trans('messages.created', ['model' => $this->model])
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
        $inventory = $this->inventory->find($id);

        $successRes = [
            'inventory' => new InventoryResource($inventory)
        ];

        return new ApiStatusResource($successRes);
    }

    /**
     * Show the form data for editing the specified resource.
     *
     * @param integer $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $inventory = $this->inventory->find($id);

        $this->authorize('update', $inventory);

        $product = $this->inventory->findProduct($inventory->product_id);

        $successRes = [
            'inventory' => new InventoryResource($inventory),
            'product'   => new ProductResource($product)
        ];

        return new ApiStatusResource($successRes);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateInventoryRequest $request, $id)
    {
        $inventory = $this->inventory->update($request, $id);

        $this->authorize('update', $inventory);

        $successRes = [
            'success' => trans('messages.updated' , ['model' => $this->model])
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
        $this->inventory->trash($id);

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
        $this->inventory->restore($id);

        $successRes = [
            'success' => trans('messages.restored', ['model' => $this->model]),
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
        $this->inventory->destroy($id);

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
        $this->inventory->massTrash($request->ids);

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
        $this->inventory->massRestore($request->ids);

        $successRes = [
            'success' => trans('messages.restored', ['model' => $this->model])
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
        $this->inventory->massDestroy($request->ids);

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
        $this->inventory->emptyTrash();

        $successRes = [
            'success' => trans('messages.deleted', ['model' => $this->model]),
        ];

        return new ApiStatusResource($successRes);
    }
}