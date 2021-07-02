<?php

namespace App\Http\Controllers\Admin\Api;

use App\Common\Authorizable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Validations\CreateInventoryRequest;
use App\Http\Resources\ApiStatusResource;
use App\Http\Resources\InventoryResource;
use App\Http\Resources\ProductResource;
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
            'inventories' => InventoryResource::collection($inventories)
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
            'inventories' => InventoryResource::collection($inventories)
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
        //
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

        $product = $this->inventory->findProduct($inventory->productId);

        $successRes = [
            'status' => 'edit',
            'inventory' => new InventoryResource($inventory),
            'product' => new ProductResource($product)
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
