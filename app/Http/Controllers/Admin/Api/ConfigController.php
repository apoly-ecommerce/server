<?php

namespace App\Http\Controllers\Admin\Api;

use Auth;
use App\Common\Authorizable;
use App\Events\Shop\ConfigUpdated;
use App\Events\Shop\DownForMaintenance;
use App\Events\Shop\UpForMaintenance;
use App\Http\Controllers\Controller;
use App\Http\Requests\Validations\ToggleMaintenanceModeRequest;
use App\Http\Requests\Validations\UpdateBasicConfigRequest;
use App\Http\Requests\Validations\UpdateConfigRequest;
use App\Http\Resources\ApiStatusResource;
use App\Http\Resources\ConfigResource;
use App\Http\Resources\ShopResource;
use App\Models\Config;
use App\Models\Shop;
use Illuminate\Http\Request;

class ConfigController extends Controller
{
    use Authorizable;

    protected $model;

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
        $config = Config::findOrFail(Auth::user()->merchantId());

        $this->authorize('view', $config);

        $successRes = [
            'config' => new ConfigResource($config)
        ];

        return new ApiStatusResource($successRes);
    }

    /**
     * Display the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function viewGeneralSetting()
    {
        $shop = Shop::findOrFail(Auth::user()->merchantId());

        $successRes = [
            'shop' => new ShopResource($shop)
        ];

        return new ApiStatusResource($successRes);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param integer $id
     * @return \Illuminate\Http\Response
     */
    public function updateBasicConfig(UpdateBasicConfigRequest $request, $id)
    {
        $config = Config::findOrFail($id);

        $this->authorize('update', $config);

        $config->shop->update($request->all());

        if ($request->hasFile('image') || ($request->input('delete_image') == 1))
            $config->shop->deleteLogo();

        if ($request->input('delete_image')){
            foreach ($request->delete_image as $type => $value) {
                $config->shop->deleteImageTypeOf($type);
            }
        }

        if ($request->hasFile('images')) {
            foreach ($request->images as $type => $file) {
                $config->shop->updateImage($file, $type);
            }
        }

        if ($request->hasFile('cover_image'))
            $config->shop->saveImage($request->file('cover_image'), true);

        $successRes = [
            'success' => trans('messages.updated' , ['model' => $this->model])
        ];

        return new ApiStatusResource($successRes);
    }

    /**
     * Toggle Maintenance Mode of the given id.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function toggleMaintenanceMode(ToggleMaintenanceModeRequest $request, $id)
    {
        $config = Config::findOrFail($id);

        $this->authorize('update', $config);

        $config->maintenance_mode = !$config->maintenance_mode;

        if ($config->save()) {
            if ($config->maintenance_mode) {
                event(new DownForMaintenance($config->shop));
            }
            else {
                event(new UpForMaintenance($config->shop));
            }

            $successRes = [
                'success' => trans('messages.updated' , ['model' => $this->model])
            ];
        }
        else {
            $successRes = [
                'failed' => trans('messages.failed')
            ];
        }

        return new ApiStatusResource($successRes);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param integer $id
     * @return \Illuminate\Http\Response
     */
    public function updateConfig(UpdateConfigRequest $request, $id)
    {
        $config = Config::findOrFail($id);

        $this->authorize('update', $config);

        if ($config->update($request->all())) {

            event(new ConfigUpdated($config->shop, Auth::user()));

            $successRes = [
                'success' => trans('messages.updated', ['model' => $this->model])
            ];
        }
        else {
            $successRes = [
                'success' => 'failed',
            ];
        }

        return new ApiStatusResource($successRes);
    }

    /**
     * Toggle Notifications of the given id.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  str  $node
     * @return \Illuminate\Http\Response
     */
    public function toggleNotification(Request $request, $node)
    {
        $config = Config::findOrFail($request->user()->merchantId());

        $this->authorize('update', $config);

        $config->$node = !$config->$node;

        if ($config->save()) {

            event(new ConfigUpdated($config->shop, Auth::user()));

            $successRes = [
                'success' => trans('messages.updated', ['model' => $this->model])
            ];
        }
        else {
            $successRes = [
                'success' => 'failed',
            ];
        }

        return new ApiStatusResource($successRes);
    }
}