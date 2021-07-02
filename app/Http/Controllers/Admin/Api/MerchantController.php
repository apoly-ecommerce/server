<?php

namespace App\Http\Controllers\Admin\Api;

use App\Common\Authorizable;
use App\Events\Profile\PasswordUpdated;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Jobs\CreateShopForMerchant;
use App\Events\User\UserCreated;
use App\Events\Shop\ShopCreated;
use App\Http\Requests\Validations\CreateMerchantRequest;
use App\Http\Requests\Validations\UpdateMerchantRequest;
use App\Http\Requests\Validations\AdminUpdateMerchantPasswordRequest;
use App\Http\Resources\MerchantResource;
use App\Http\Resources\ApiStatusResource;
use App\Repositories\Merchant\MerchantRepository;
use App\Repositories\User\UserRepository;

class MerchantController extends Controller
{

    use Authorizable;

    protected $model;
    protected $merchant;
    protected $user;

    /**
     * Constructor.
     *
     * @param MerchantRepository $merchant
     */
    public function __construct(MerchantRepository $merchant, UserRepository $user)
    {
        $this->model = trans('app.model.merchant');
        $this->merchant = $merchant;
        $this->user = $user;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function paginate(Request $request)
    {
        $merchants = $this->merchant->allWithPaginate($request->limit);

        $successRes = [
            'merchants' => MerchantResource::collection($merchants),
            'total'  => $this->merchant->all()->count(),
        ];

        return new ApiStatusResource($successRes);
    }

     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function trashedPaginate(Request $request)
    {
        $merchants = $this->merchant->trashOnlyWithPaginate($request->limit);

        $successRes = [
            'merchants' => MerchantResource::collection($merchants),
            'total'  => $this->merchant->all()->count(),
        ];

        return new ApiStatusResource($successRes);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateMerchantRequest $request)
    {
        $merchant = $this->merchant->store($request);

        $user = $this->user->find($merchant->id);
        // // Dispatching Shop create job.
        CreateShopForMerchant::dispatch($user, $request->all());

        // Trigger user created event.
        event(new UserCreated($user, auth()->user()->getName(), $request->get('password')));

        // Trigger shop created event.
        event(new ShopCreated($merchant->owns));

        $successRes = [
            'success' => trans('messages.created', ['model' => $this->model])
        ];

        return new ApiStatusResource($successRes);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $merchant = $this->merchant->find($id);

        $successRes = [
            'merchant' => new MerchantResource($merchant)
        ];

        return new ApiStatusResource($successRes);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMerchantRequest $request, $id)
    {
        $this->merchant->update($request, $id);

        $successRes = [
            'success' => trans('messages.updated', ['model' => $this->model])
        ];

        return new ApiStatusResource($successRes);
    }

    /**
     * Update login passport only.
     *
     * @param  App\Http\Requests\Validations\AdminUpdateMerchantPasswordRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function updatePassword(AdminUpdateMerchantPasswordRequest $request, $id)
    {
        $merchant = $this->merchant->update($request, $id);

        $user = $this->user->find($merchant->id);

        event(new PasswordUpdated($user));

        $successRes = [
            'success' => trans('messages.password_updated', ['model' => $this->model])
        ];

        return new ApiStatusResource($successRes);

    }

    /**
     * Trash the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function trash($id)
    {
        $this->merchant->trash($id);

        $successRes = [
            'success' => trans('messages.trashed', ['model' => $this->model]),
        ];

        return new ApiStatusResource($successRes);
    }

    /**
     * Trash the mass resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function massTrash(Request $request)
    {
        $this->merchant->massTrash($request->ids);

        $successRes = [
            'success' => trans('messages.trashed', ['model' => $this->model]),
        ];

        return new ApiStatusResource($successRes);
    }

    /**
     * Restore the specified resource from soft delete.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        $this->merchant->restore($id);

        $successRes = [
            'success' => trans('messages.restored', ['model' => $this->model]),
        ];

        return new ApiStatusResource($successRes);
    }

    /**
     * Restore the mass resources.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function massRestore(Request $request)
    {
        $this->merchant->massRestore($request->ids);

        $successRes = [
            'success' => trans('messages.restored', ['model' => $this->model]),
            'status'  => 200
        ];

        return new ApiStatusResource($successRes);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $this->merchant->destroy($id);

      $successRes = [
          'success' => trans('messages.deleted', ['model' => $this->model]),
      ];

      return new ApiStatusResource($successRes);
    }

    /**
     * Destroy the mass resources.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function massDestroy(Request $request)
    {
        $this->merchant->massDestroy($request->ids);

        $successRes = [
            'success' => trans('messages.deleted', ['model' => $this->model]),
            'status'  => 200
        ];

        return new ApiStatusResource($successRes);
    }

    /**
     * Empty the Trash the mass resources.
     *
     * @return \Illuminate\Http\Response
     */
    public function emptyTrash()
    {
        $this->merchant->emptyTrash();

        $successRes = [
            'success' => trans('messages.deleted', ['model' => $this->model])
        ];

        return new ApiStatusResource($successRes);
    }
}
