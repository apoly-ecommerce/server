<?php

namespace App\Http\Controllers\Admin\Api;

use App\Common\Authorizable;
use App\Http\Controllers\Controller;
use App\Http\Resources\ApiStatusResource;
use App\Http\Resources\ModuleResource;
use App\Repositories\Module\ModuleRepository;
use Illuminate\Http\Request;

class ModuleController extends Controller
{

    use Authorizable;

    protected $model_name;
    protected $module;

    /**
     * Constructor.
     */
    public function __construct(ModuleRepository $module)
    {
        $this->model_name  = trans('app.model.module');
        $this->module = $module;
    }

    /**
     * Get list all module.
     *
     * @return void
     */
    public function index()
    {
        $modules = $this->module->all();

        $successRes = [
            'modules' => ModuleResource::collection($modules),
            'status' => 200
        ];

        return new ApiStatusResource($successRes);
    }
}