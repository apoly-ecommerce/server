<?php

namespace App\Http\Controllers\Admin\Api;

use App\Common\Authorizable;
use App\Events\System\SystemConfigUpdated;
use App\Http\Controllers\Controller;
use App\Http\Requests\Validations\UpdateSystemConfigRequest;
use App\Http\Resources\ApiStatusResource;
use App\Http\Resources\SystemConfigResource;
use App\Models\SystemConfig;
use Illuminate\Http\Request;

class SystemConfigController extends Controller
{
    private $model;

    public function __construct()
    {
        $this->model = trans('app.model.config');
    }

    /**
     * Display the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function view()
    {
        $system = SystemConfig::orderBy('id', 'asc')->first();

        $this->authorize('view', $system);

        $successRes = [
            'system' => new SystemConfigResource($system)
        ];

        return new ApiStatusResource($successRes);
    }

    /**
     * Update specified resource.
     *
     * @param \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSystemConfigRequest $request)
    {
        $system = SystemConfig::orderBy('id', 'asc')->first();

        $this->authorize('update', $system);

        if ($system->update($request->all())) {
            event(new SystemConfigUpdated($system));

            $successRes = [
                'success' => trans('messages.updated' , ['model' => $this->model])
            ];

            return new ApiStatusResource($successRes);
        }

        $failRes = [
            'error' => trans('messages.failed')
        ];

        return (new ApiStatusResource($failRes))->setStatusCode(405);
    }

    /**
     * Toggle config of the given node.
     *
     * @param \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function toggleConfig(UpdateSystemConfigRequest $request, $node)
    {
        $system = SystemConfig::orderBy('id', 'asc')->first();

        $this->authorize('update', $system);

        $system->$node = !$system->$node;

        if ($system->save()) {
            event(new SystemConfigUpdated($system));

            $successRes = [
                'success' => trans('messages.updated' , ['model' => $this->model])
            ];

            return new ApiStatusResource($successRes);
        }

        $failRes = [
            'error' => trans('messages.failed')
        ];

        return (new ApiStatusResource($failRes))->setStatusCode(405);
    }
}