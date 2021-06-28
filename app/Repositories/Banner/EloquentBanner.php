<?php

namespace App\Repositories\Banner;

use App\Models\Banner;
use App\Repositories\BaseRepository;
use App\Repositories\EloquentRepository;

class EloquentBanner extends EloquentRepository implements BaseRepository, BannerRepository
{
    protected $model;

    public function __construct(Banner $banner)
    {
        $this->model = $banner;
    }

    public function all()
    {
        return $this->model->with('group', 'featureImage')->orderBy('order', 'asc')->get();
    }

    public function allWithPaginate($limit)
    {
        return $this->model->with('group', 'featureImage')->orderBy('order', 'asc')->paginate($limit);
    }

    public function trashOnlyWithPaginate($limit)
    {
        return $this->model->onlyTrashed()->with('group', 'featureImage')->orderBy('order', 'asc')->paginate($limit);
    }

    public function destroy($id)
    {
        $banner = parent::findTrash($id);

        $banner->flushImages();

        return $banner->forceDelete();
    }

    public function massDestroy($ids)
    {
        $banners = $this->model->withTrashed()->whereIn('id', $ids)->get();

        foreach ($banners as $banner) {
            $banner->flushImages();
        }

        return parent::massDestroy($ids);
    }
}