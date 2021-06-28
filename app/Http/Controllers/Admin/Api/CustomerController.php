<?php

namespace App\Http\Controllers\Admin\Api;

use App\Common\Authorizable;
use App\Events\Customer\PasswordUpdated;
use App\Http\Controllers\Controller;
use App\Http\Resources\ApiStatusResource;
use App\Http\Resources\CustomerResource;
use App\Http\Requests\Validations\CreateCustomerRequest;
use App\Repositories\Customer\CustomerRepository;
use Illuminate\Http\Request;
use App\Http\Requests\Validations\AdminCustomerUpdatePasswordRequest as UpdatePasswordRequest;

class CustomerController extends Controller
{
    use Authorizable;

    protected $model;
    protected $user;

    /**
     * Construct
     */
    public function __construct(CustomerRepository $customer)
    {
        $this->model = trans('app.model.customer');
        $this->customer = $customer;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return 'index method';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function allPaginate(Request $request)
    {
        $customers = $this->customer->allWithPaginate($request->limit);

        $successRes = [
            'customers' => CustomerResource::collection($customers),
            'total' => $this->customer->all()->count(),
        ];

        return new ApiStatusResource($successRes);

    }

    /**
     * Display a listing trashed of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function allTrashedPaginate(Request $request)
    {
        $customers = $this->customer->trashOnlyWithPaginate($request->limit);

        $successRes = [
            'customers' => CustomerResource::collection($customers),
            'total' => $this->customer->all()->count(),
        ];

        return new ApiStatusResource($successRes);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateCustomerRequest $request)
    {
        $this->customer->store($request);

        $successRes = [
            'success' => trans('messages.created', ['model' => $this->model]),
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
        $customer = $this->customer->find($id);

        $successRes = [
            'customer' => new CustomerResource($customer)
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
    public function update(Request $request, $id)
    {
        $this->customer->update($request, $id);

        $successRes = [
            'success' => trans('messages.updated', ['model' => $this->model]),
        ];

        return new ApiStatusResource($successRes);
    }


    /**
     * Update password
     *
     * @param App\Http\Requests\Validations\UpdatePasswordRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updatePassword(UpdatePasswordRequest $request, $id)
    {
        $customer = $this->customer->update($request, $id);

        event(new PasswordUpdated($customer));

        $successRes = [
            'success' => trans('messages.password_updated'),
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
        $this->customer->trash($id);

        $successRes = [
            'success' => trans('messages.trashed', ['model' => $this->model]),
        ];

        return new ApiStatusResource($successRes);
    }

    /**
     * Trash the mass resources.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function massTrash(Request $request)
    {
        $this->customer->massTrash($request->ids);

        $successRes = [
            'success' => trans('messages.trashed', ['model' => $this->model]),
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
        $this->customer->destroy($id);

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
        $this->customer->massDestroy($request->ids);

        $successRes = [
            'success' => trans('messages.deleted', ['model' => $this->model])
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
        $this->customer->restore($id);

        $successRes = [
            'success' => trans('messages.restored', ['model' => $this->model])
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
        $this->customer->massRestore($request->ids);

        $successRes = [
            'success' => trans('messages.restored', ['model' => $this->model])
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
        $this->customer->emptyTrash();

        $successRes = [
            'success' => trans('messages.deleted', ['model' => $this->model])
        ];

        return new ApiStatusResource($successRes);
    }
}
