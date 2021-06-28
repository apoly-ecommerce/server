<?php

namespace App\Repositories\Product;

use App\Models\MediaProduct;
use Auth;
use App\Models\Product;
use App\Repositories\BaseRepository;
use App\Repositories\EloquentRepository;
use Illuminate\Http\Request;
use Carbon\Carbon;

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
            return $this->model->onlyTrashed()->with('categories', 'mediaProducts')->paginate($limit);
        }
        return $this->model->mine()->onlyTrashed()->with('categories', 'mediaProducts')->paginate($limit);
    }

    public function store(Request $request)
    {
        $product = parent::store($request);

        if ($request->input('category_list')) {
            $product->categories()->sync($request->input('category_list'));
        }

        if ($request->input('media_list')) {

            $mediaProduct = [];
            $date = Carbon::Now();

            foreach($request->input('media_list') as $media) {
                $mediaProduct[] = [
                    'product_id' => $product->id,
                    'type' => $media['type'],
                    'url' => $media['url'],
                    'created_at' => $date,
                    'updated_at' => $date
                ];
            }

            \DB::table('media_products')->insert($mediaProduct);
        }

        return $product;
    }

    public function update(Request $request, $id)
    {
        $product = parent::update($request, $id);

        $product->categories()->sync($request->input('category_list'), []);

        $product->mediaProducts()->delete();

        if ($request->input('media_list')) {

            $mediaProduct = [];
            $date = Carbon::Now();

            foreach($request->input('media_list') as $media) {
                $mediaProduct[] = [
                    'product_id' => $product->id,
                    'type' => $media['type'],
                    'url' => $media['url'],
                    'created_at' => $date,
                    'updated_at' => $date
                ];
            }

            \DB::table('media_products')->insert($mediaProduct);
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