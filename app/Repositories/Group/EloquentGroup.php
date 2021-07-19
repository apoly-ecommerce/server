<?php

namespace App\Repositories\Group;

use App\Models\Group;
use Illuminate\Http\Request;
use App\Repositories\BaseRepository;
use App\Repositories\EloquentRepository;

class EloquentGroup extends EloquentRepository implements BaseRepository, GroupRepository
{
    protected $model;

    public function __construct(Group $group)
    {
        $this->model = $group;
    }

    public function store(Request $request)
    {
        $group = parent::store($request);

        if ($request->input('user_list')) {
            $group->user()->sync($request->input('user_list'));
        }

        if ($request->hasFile('image')) {
            $group->saveImage($request->input('image'));
        }

        return $group;
    }
}