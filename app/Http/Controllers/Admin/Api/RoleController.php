<?php

namespace App\Http\Controllers\Admin\Api;

use Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\RoleResource;
use App\Repositories\Role\RoleRepository;
use App\Http\Resources\ApiStatusResource;
use App\Http\Resources\PermissionResource;
use App\Http\Requests\Validations\CreateRoleRequest;
use App\Http\Requests\Validations\UpdateRoleRequest;

class RoleController extends Controller
{

    protected $model_name;
    protected $role;

    /**
     * Constructor.
     */
    public function __construct(RoleRepository $role)
    {
        $this->model_name = trans('app.model.role');
        $this->role  = $role;
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $roles = $this->role->allWithPaginate($request->limit);

        $successRes = [
            'roles'  => $roles,
            'status' => 200
        ];

        return new ApiStatusResource($successRes);
    }

    /**
     * Get list role trashed.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function allTrashed(Request $request)
    {
        $roles = $this->role->trashOnlyWithPaginate($request->limit);

        $successRes = [
            'trashed' => $roles,
            'status'  => 200
        ];

        return new ApiStatusResource($successRes);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\CreateRoleRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateRoleRequest $request)
    {
        $this->role->store($request);

        $successRes = [
            'success' => trans('message.created', ['model' => $this->model_name]),
            'status' => 200
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
        $role = $this->role->find($id);

        $role_permissions = isset($role) ? $role->permissions()->get()->toArray() : [];

        $successRes = [
            'role' => (new RoleResource($role)),
            'role_permissions' => (PermissionResource::collection($role_permissions)),
            'status' => 200
        ];

        return new ApiStatusResource($successRes);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\UpdateRoleRequest $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRoleRequest $request, $id)
    {
        $this->role->update($request, $id);

        $successRes = [
            'success' => trans('message.updated', ['model' => $this->model_name]),
            'status'  => 200
        ];

        return new ApiStatusResource($successRes);
    }

    /**
     * Trash the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function trash($id)
    {
        $this->role->trash($id);

        $successRes = [
            'success' => trans('message.trashed', ['model' => $this->model_name]),
            'status'  => 200
        ];

        return new ApiStatusResource($successRes);
    }

    /**
     * Trash the mass resource.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function massTrash(Request $request)
    {
        $this->role->massTrash($request->ids);

        $successRes = [
            'success' => trans('message.trashed', ['model' => $this->model_name]),
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

        $this->role->destroy($id);

        $successRes = [
            'success' => trans('message.deleted', ['model' => $this->model_name]),
            'status'  => 200
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
        $this->role->massDestroy($request->ids);

        $successRes = [
            'success' => trans('message.deleted', ['model' => $this->model_name]),
            'status'  => 200
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
        $this->role->restore($id);

        $successRes = [
            'success' => trans('message.restored', ['model' => $this->model_name]),
            'status'  => 200
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
        $this->role->massRestore($request->ids);

        $successRes = [
            'success' => trans('message.restored', ['model' => $this->model_name]),
            'status'  => 200
        ];

        return new ApiStatusResource($successRes);
    }

    /**
     * Get all the list role for the user.
     *
     * @return \Illuminate\Http\Response
     */
    public function getRolePermissionsByUser()
    {
        $user = Auth::user();

        if ($user->role_id) {
            $role = $this->role->find($user->role_id);
            $role_permission = isset($role) ? $role->permissions()->get()->toArray() : [];
            $successRes = [
                'role' => new RoleResource($role),
                'role_permissions' => PermissionResource::collection($role_permission),
                'status' => 200
            ];
            return new ApiStatusResource($successRes);
        }
    }
}
