<?php

namespace App\Repositories\CategorySubGroup;

use App\Models\CategorySubGroup;
use App\Repositories\BaseRepository;
use App\Repositories\EloquentRepository;

class EloquentCategorySubGroup extends EloquentRepository implements BaseRepository, CategorySubGroupRepository
{
    protected $model;

    public function __construct(CategorySubGroup $categorySubGroup)
    {
        $this->model = $categorySubGroup;
    }

    public function all()
    {
        return $this->model->with('group:id,name,deleted_at', 'categories')->withCount('categories')->orderBy('order', 'asc')->get();
    }

    public function allWithPaginate($limit)
    {
        return $this->model->with('group:id,name,deleted_at')->withCount('categories')->orderBy('order', 'asc')->paginate($limit);
    }

    public function trashOnlyWithPaginate($limit)
    {
        return $this->model->with('group:id,name,deleted_at')->onlyTrashed()->withCount('categories')->orderBy('order', 'asc')->paginate($limit);
    }

    public function destroy($id)
    {
        $catSubGrp = parent::findTrash($id);

        $catSubGrp->flushImages();

        return parent::destroy($id);
    }

    public function massDestroy($ids)
    {
        $catSubGrps = $this->model->withTrashed()->whereIn('id', $ids)->get();

        foreach ($catSubGrps as $catSubGrp) {
            $catSubGrp->flushImages();
        }

        return parent::massDestroy($ids);
    }

    public function emptyTrash()
    {
        $catSubGrps = $this->model->onlyTrashed()->get();

        foreach ($catSubGrps as $catSubGrp) {
          $catSubGrp->flushImages();
      }

        return parent::emptyTrash();
    }

}