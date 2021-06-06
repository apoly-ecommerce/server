<?php

namespace App\Repositories\Category;

use App\Models\Category;
use App\Repositories\BaseRepository;
use App\Repositories\EloquentRepository;
use Illuminate\Http\Request;

class EloquentCategory extends EloquentRepository implements BaseRepository, CategoryRepository
{
    protected $model;

    public function __construct(Category $category)
    {
        $this->model = $category;
    }

    public function all()
    {
        return $this->model->with('subGroup:id,name,category_group_id,deleted_at', 'subGroup.group:id,name,deleted_at')
        ->withCount('products')->get();
    }

    public function allWithPaginate($limit)
    {
        return $this->model->with('subGroup:id,name,category_group_id,deleted_at', 'subGroup.group:id,name,deleted_at')
        ->withCount('products')->paginate($limit);
    }

    public function trashOnlyWithPaginate($limit)
    {
        return $this->model->with('subGroup:id,name,category_group_id,deleted_at', 'subGroup.group:id,name,deleted_at')->onlyTrashed()->withCount('products')->orderBy('order', 'asc')->paginate($limit);
    }

    public function destroy($id)
    {
        $cat = parent::findTrash($id);

        $cat->flushImages();

        return parent::destroy($id);
    }

    public function massDestroy($ids)
    {
        $cats = $this->model->withTrashed()->whereIn('id', $ids)->get();

        foreach ($cats as $cat) {
            $cat->flushImages();
        }

        return parent::massDestroy($ids);
    }
}