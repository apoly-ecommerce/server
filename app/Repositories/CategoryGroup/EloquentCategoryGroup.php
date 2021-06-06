<?php

namespace App\Repositories\CategoryGroup;

use App\Models\CategoryGroup;
use App\Repositories\BaseRepository;
use App\Repositories\EloquentRepository;
use Illuminate\Http\Request;

class EloquentCategoryGroup extends EloquentRepository implements BaseRepository, CategoryGroupRepository
{

    protected $model;

    public function __construct(CategoryGroup $categoryGroup)
    {
        $this->model = $categoryGroup;
    }

    public function all()
    {
        return $this->model->with('subGroups', 'subGroups.categories')->get();
    }

    public function allWithPaginate($limit)
    {
        return $this->model->withCount('subGroups')->orderBy('order', 'asc')->paginate($limit);
    }

    public function trashOnlyWithPaginate($limit)
    {
        return $this->model->onlyTrashed()->withCount('subGroups')->orderBy('order', 'asc')->paginate($limit);
    }

    public function destroy($id)
    {
        $catGrp = parent::findTrash($id);

        $catGrp->flushImages();

        return parent::destroy($id);
    }

    public function massDestroy($ids)
    {
        $catGrps = $this->model->withTrashed()->whereIn('id', $ids)->get();

        foreach ($catGrps as $catGrp) {
            $catGrp->flushImages();
        }

        return parent::massDestroy($ids);
    }

}