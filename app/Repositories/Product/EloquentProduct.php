<?php

namespace App\Repositories\Product;

use Auth;
use App\Models\Product;
use App\Repositories\BaseRepository;
use App\Repositories\EloquentRepository;
use Illuminate\Http\Request;

class EloquentProduct extends EloquentRepository implements BaseRepository, ProductRepository
{
    protected $model;

    public function __construct(Product $product)
    {
        $this->model = $product;
    }

    public function allWithPaginate($limit)
    {
        if (Auth::user()->isFromPlatform()) {
            return $this->model->with('categories')->paginate($limit);
        }
        return $this->model->mine()->with('categories')->paginate($limit);
    }

    public function trashOnlyWithPaginate($limit)
    {
        if (Auth::user()->isFromPlatform()) {
            return $this->model->onlyTrashed()->with('categories')->paginate($limit);
        }
        return $this->model->mine()->onlyTrashed()->with('categories')->paginate($limit);
    }

    public function store(Request $request)
    {
        $product = parent::store($request);

        if ($request->input('category_list')) {
            $product->categories()->sync($request->input('category_list'));
        }

        return $product;
    }

    public function destroy($id)
    {
        $product = parent::findTrash($id);

        $product->flushImages();

        return $product->forceDelete();

    }

    public function massDestroy($ids)
    {
        $products = $this->model->withTrashed()->where('id', $ids)->get();

        foreach ($products as $product) {
            $product->flushImages();
        }

        return parent::massDestroy($products);
    }

    public function emptyTrash()
    {
        $products = $this->model->onlyTrashed()->get();

        foreach ($products as $product) {
            $product->flushImages();
        }

        return parent::emptyTrash();
    }
}