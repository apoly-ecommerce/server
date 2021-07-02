<?php
namespace App\Repositories\Inventory;

use Auth;
use App\Models\Inventory;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Repositories\BaseRepository;
use App\Repositories\EloquentRepository;

class EloquentInventory extends EloquentRepository implements BaseRepository, InventoryRepository
{
    protected $model;

    public function __construct(Inventory $inventory)
    {
        $this->model = $inventory;
    }

    public function allWithPaginate($limit)
    {
        if (! Auth::user()->isFromPlatform()) {
            return $this->model->mine()->with('product', 'image')->paginate($limit);
        }

        return $this->model->with('product', 'image')->paginate($limit);
    }

    public function trashOnlyWithPaginate($limit)
    {
        if (! Auth::user()->isFromPlatform()) {
            return $this->model->mine()->onlyTrashed()->with('product', 'image')->paginate($limit);
        }

        return $this->model->onlyTrashed()->with('product', 'image')->paginate($limit);
    }

    public function findProduct($id)
    {
        return Product::findOrFail($id);
    }

    public function checkInventoryExists($productId)
    {
        return $this->model->mine()->where('product_id', $productId)->first();
    }
}