<?php

namespace App\Repositories\Merchant;

use App\User;
use App\Models\Role;
use App\Repositories\BaseRepository;
use App\Repositories\EloquentRepository;
use Illuminate\Http\Request;

class EloquentMerchant extends EloquentRepository implements BaseRepository, MerchantRepository
{

    protected $model;

    public function __construct(User $merchant)
    {
        $this->model = $merchant;
    }

    public function allWithPaginate($limit)
    {
        return $this->model->where('role_id', Role::MERCHANT)
        ->with('owns', 'image', 'primaryAddress')->paginate($limit);
    }

    public function trashOnlyWithPaginate($limit)
    {
        return $this->model->where('role_id', Role::MERCHANT)->onlyTrashed()
        ->with('owns', 'image', 'primaryAddress')->paginate($limit);
    }

    public function addresses($merchant)
    {
        return $merchant->addresses()->get();
    }

    public function saveAddress(array $address, $merchant)
    {
        $merchant->addresses()->create($address);
    }

    public function store(Request $request)
    {
        $merchant = parent::store($request);

        $this->saveAddress($request->all(), $merchant);

        if ($request->hasFile('image')) {
            $merchant->saveImage($request->file('image'));
        }

        return $merchant;
    }

    public function update(Request $request, $id)
    {
        $merchant = parent::update($request, $id);

        if ($request->hasFile('image') || ($request->input('delete_avatar') == '1')) {
            $merchant->deleteImage();
        }

        if ($request->hasFile('image')) {
            $merchant->saveImage($request->file('image'));
        }

        return $merchant;
    }

    public function destroy($id)
    {
        $merchant = parent::findTrash($id);

        $merchant->flushImages();

        $merchant->flushAddresses();

        return $merchant->forceDelete();
    }

    public function massDestroy($ids)
    {
        $merchants = $this->model->onlyTrashed()->whereIn('id', $ids)->get();

        foreach ($merchants as $merchant) {
            $merchant->flushImages();

            $merchant->flushAddresses();
        }

        return parent::massDestroy($ids);
    }

    public function emptyTrash()
    {
        $merchants = $this->model->onlyTrashed()->get();

        foreach ($merchants as $merchant){
            $merchant->flushAddresses();
            $merchant->flushImages();
        }

        return parent::emptyTrash();
    }

}