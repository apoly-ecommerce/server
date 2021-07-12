<?php

namespace App\Http\Controllers\Admin\Api;

use App\Common\Authorizable;
use App\Events\System\DownForMaintenance;
use App\Events\System\UpForMaintenance;
use App\Events\System\SystemInfoUpdated;
use App\Http\Controllers\Controller;
use App\Http\Requests\Validations\UpdateBasicSystemConfigRequest;
use App\Http\Requests\Validations\UpdateSystemRequest;
use App\Http\Resources\ApiStatusResource;
use App\Http\Resources\SystemGeneralResource;
use App\Models\System;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SystemController extends Controller
{
    use Authorizable;

    protected $model;

    /**
     * Constructor
     */
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
        $system = System::orderBy('id', 'asc')->first();

        $successRes = [
            'system' => new SystemGeneralResource($system)
        ];

        return new ApiStatusResource($successRes);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param App\Http\Requests\Validations\UpdateBasicSystemConfigRequest $request
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBasicSystemConfigRequest $request)
    {
        $system = System::orderBy('id', 'asc')->first();

        $this->authorize('update', $system);

        $system->update($request->except('image', 'delete_image'));

        if ($request->hasFile('icon')) {
            $request->file('icon')->storeAs('', 'icon.png');
            Storage::deleteDirectory(image_cache_path('icon.png'));
        }

        if ($request->hasFile('logo')) {
            $request->file('logo')->storeAs('', 'logo.png');
            Storage::deleteDirectory(image_cache_path('logo.png'));
        }

        $successRes = [
            'success' => trans('messages.updated', ['model' => $this->model])
        ];

        return new ApiStatusResource($successRes);
    }

    /**
     * Toggle Maintenance Mode of the given id.
     *
     * @param App\Http\Requests\Validations\UpdateSystemRequest
     * @return \Illuminate\Http\Response
     */
    public function toggleMaintenanceMode(UpdateSystemRequest $request)
    {
        $system = System::orderBy('id', 'asc')->first();

        $this->authorize('update', $system);

        $system->maintenance_mode = !$system->maintenance_mode;

        if ($system->save()) {
            if ($system->maintenance_mode) {
                event(new DownForMaintenance($system));
            }
            else {
                event(new UpForMaintenance($system));
            }

            $successRes = [
                'success' => trans('messages.updated', ['model' => $this->model])
            ];

        }
        else {
            $successRes = [
                'failed' => trans('messages.failed')
            ];
        }

        return new ApiStatusResource($successRes);
    }
}