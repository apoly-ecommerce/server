<?php

namespace App\Repositories\Shop;

use App\Models\Shop;
use Illuminate\Http\Request;
use App\Events\Shop\ShopDeleted;
use App\Repositories\BaseRepository;
use App\Repositories\EloquentRepository;

class EloquentShop extends EloquentRepository implements BaseRepository, ShopRepository
{
    protected $model;

    public function __construct(Shop $shop)
    {
        $this->model = $shop;
    }

    public function allWithPaginate($limit)
    {
        return $this->model->with('owner.image', 'primaryAddress')->paginate($limit);
    }

    public function onlyTrashedWithPaginate($limit)
    {
        return $this->model->onlyTrashed()->with('owner.image', 'primaryAddress')->paginate($limit);
    }

    public function staffs($shop)
    {
        return $shop->staffs()->with('role', 'primaryAddress')->get();
    }

    public function staffsPaginate($shop, $limit)
    {
        return $shop->staffs()->with('role', 'primaryAddress')->paginate($limit);
    }

    public function staffTrashOnly($shop)
    {
        return $shop->staffs()->onlyTrashed()->with('role', 'primaryAddress')->get();
    }

    public function staffTrashOnlyPaginate($shop, $limit)
    {
        return $shop->staffs()->onlyTrashed()->with('role', 'primaryAddress')->paginate($limit);
    }

    public function saveAddress(array $address, $shop)
    {
        $shop->addresses()->create($address);
    }

    public function update(Request $request, $id)
    {
        $shop = parent::update($request, $id);

        return $shop;
    }

    public function destroy($id)
    {
        $shop = parent::findTrash($id);

        $shop->flushImages();

        $shop->flushAddresses();

        $shop->staffs()->forceDelete();

        if ($shop->hasFeedback()) {
            $shop->flushFeedback();
        }

        return $shop->forceDelete();
    }

    public function massTrash($ids)
    {
        $shops = $this->model->withTrashed()->where('id', $ids)->get();

        foreach ($shops as $shop) {
            $shop->owner()->delete();
            $shop->staffs()->delete();

            event(new ShopDeleted($shop->id));
        }

        return parent::massTrash($ids);
    }

    public function massDestroy($ids)
    {
        $shops = $this->model->withTrashed()->where('id', $ids)->get();

        foreach ($shops as $shop){
            $shop->flushAddresses();
            $shop->flushImages();
            $shop->staffs()->forceDelete();
            $shop->flushFeedbacks();
        }

        return parent::massDestroy($ids);
    }

    public function emptyTrash()
    {
        $shops = $this->model->onlyTrashed()->get();

        foreach ($shops as $shop){
            $shop->flushAddresses();
            $shop->staffs()->forceDelete();
            $shop->flushFeedbacks();
            $shop->flushImages();
        }

        return parent::emptyTrash();
    }
}