<?php

namespace App\Repositories\Module;

use App\Models\Module;
use App\Repositories\BaseRepository;
use App\Repositories\EloquentRepository;

class EloquentModule extends EloquentRepository implements BaseRepository, ModuleRepository
{
    protected $model;

    public function __construct(Module $module)
    {
        $this->model = $module;
    }
}