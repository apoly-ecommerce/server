<?php

namespace App\Repositories\Manufacturer;

use Auth;
use App\Models\Manufacturer;
use App\Repositories\BaseRepository;
use App\Repositories\EloquentRepository;

class EloquentManufacturer extends EloquentRepository implements BaseRepository, ManufacturerRepository
{

    protected $model;

    public function __construct(Manufacturer $manufacturer)
    {
        $this->model = $manufacturer;
    }

    public function all()
    {
        if (! Auth::user()->isFromPlatform()) {
            return $this->model->mine()->with('country:id,name')->withCount('products')->get();
        }

        return $this->model->with('country:id,name')->withCount('products')->get();
    }

    public function allWithPaginate($limit)
    {
        if (! Auth::user()->isFromPlatform()) {
            return $this->model->mine()->with('country:id,name')->withCount('products')->paginate($limit);
        }

        return $this->model->with('country:id,name')->withCount('products')->paginate($limit);
    }

    public function trashOnlyWithPaginate($limit)
    {
       if (! Auth::user()->isFromPlatform()) {
            return $this->model->mine()->with('country:id,name')->onlyTrashed()->withCount('products')->paginate($limit);
       }

       return $this->model->with('country:id,name')->onlyTrashed()->withCount('products')->paginate($limit);
    }

    public function destroy($id)
    {
        $manufacturer = parent::findTrash($id);

        $manufacturer->flushImages();

        return $manufacturer->forceDelete();
    }

    public function massDestroy($ids)
    {
        $manufacturers = $this->model->withTrashed()->whereIn('id', $ids)->get();

        foreach ($manufacturers as $manufacturer) {
            $manufacturer->flushImages();
        }

        return parent::massDestroy($manufacturers);
    }

    public function emptyTrash()
    {
        $manufacturers = $this->model->onlyTrashed()->get();

        foreach ($manufacturers as $manufacturer) {
            $manufacturer->flushImages();
        }

        return parent::emptyTrash();
    }

}