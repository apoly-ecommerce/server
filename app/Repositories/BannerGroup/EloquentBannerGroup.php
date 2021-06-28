<?php

namespace App\Repositories\BannerGroup;

use App\Models\BannerGroup;
use App\Repositories\BaseRepository;
use App\Repositories\EloquentRepository;

class EloquentBannerGroup extends EloquentRepository implements BaseRepository, BannerGroupRepository
{
    protected $model;

    public function __construct(BannerGroup $bannerGroup)
    {
        $this->model = $bannerGroup;
    }

    public function all()
    {
        return $this->model->get();
    }
}