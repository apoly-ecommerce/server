<?php

namespace App\Repositories\Customer;

use App\Models\Customer;
use App\Repositories\BaseRepository;
use App\Repositories\EloquentRepository;
use Illuminate\Http\Request;

class EloquentCustomer extends EloquentRepository implements BaseRepository, CustomerRepository
{
    protected $model;

    public function __construct(Customer $customer)
    {
        $this->model = $customer;
    }

    public function all()
    {
        return $this->model->with('image', 'primaryAddress')->withCount('orders')->get();
    }

    public function allWithPaginate($limit)
    {
        return $this->model->with('image', 'primaryAddress')->withCount('orders')->paginate($limit);
    }

    public function trashOnlyWithPaginate($limit)
    {
        return $this->model->onlyTrashed()->with('image', 'primaryAddress')->withCount('orders')->paginate($limit);
    }

    public function profile($id)
    {
        return $this->model->findOrFail($id);
    }

    public function addresses($customer)
    {
        return $customer->addresses()->get();
    }

    public function store(Request $request)
    {
        $customer = parent::store($request);

        $this->saveAddress($request->all(), $customer);

        if ($request->hasFile('image')) {
            $customer->saveImage($request->file('image'));
        }

        return $customer;
    }

    public function update(Request $request, $id)
    {
        $customer = parent::update($request, $id);

        if ($request->hasFile('image') || $request->input('delete_avatar') == '1') {
            $customer->deleteImage();
        }

        if ($request->hasFile('image')) {
            $customer->saveImage($request->file('image'));
        }

        return $customer;
    }

    public function destroy($id)
    {
        $customer = parent::findTrash($id);

        $customer->flushAddresses();

        $customer->flushImages();

        return $customer->forceDelete();
    }

    public function massDestroy($ids)
    {
        $customers = $this->model->withTrashed()->whereIn('id', $ids)->get();

        foreach ($customers as $customer) {
            $customer->flushAddresses();
            $customer->flushImages();
        }

        return parent::massDestroy($ids);
    }

    public function emptyTrash()
    {
        $customers = $this->model->onlyTrashed()->get();

        foreach ($customers as $customer){
            $customer->flushAddresses();
            $customer->flushImages();
        }

        return parent::emptyTrash();
    }

    public function saveAddress(array $address, $customer)
    {
        $customer->addresses()->create($address);
    }
}