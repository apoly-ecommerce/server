<?php

namespace App\Http\Controllers\Admin\Api;

use Auth;
use App\Common\Authorizable;
use App\Events\User\PasswordUpdated;
use App\Events\User\UserCreated;
use App\Events\User\UserUpdated;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Http\Resources\UserAuthResource;
use App\Http\Resources\ApiStatusResource;
use App\Repositories\User\UserRepository;
use App\Http\Requests\Validations\CreateUserRequest;
use App\Http\Requests\Validations\UpdateUserRequest;
use App\Http\Requests\Validations\AdminUserUpdatePasswordRequest as UpdatePasswordRequest;

class UserController extends Controller
{
    use Authorizable;

    protected $model;
    protected $user;

    public function __construct(UserRepository $user)
    {
        $this->model = trans('app.model.user');
        $this->user  = $user;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return 'handle all user !';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function allPaginate(Request $request)
    {
        $users = $this->user->allWithPaginate($request->limit);

        $successRes = [
            'users' => UserResource::collection($users),
            'total'  => $this->user->all()->count(),
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
        $users = $this->user->trashOnlyWithPaginate($request->limit);

        $successRes = [
            'users' => UserResource::collection($users),
            'total'  => $this->user->trashOnly()->count(),
        ];

        return new ApiStatusResource($successRes);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param App\Http\Requests\Validations\CreateUserRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateUserRequest $request)
    {
        $user = $this->user->store($request);

        event(new UserCreated($user, auth()->user()->getName(), $request->get('password')));

        $successRes = [
            'success' => trans('messages.created', ['model' => $this->model]),
            'user' => new UserResource($user),
        ];

        return new ApiStatusResource($successRes);
    }

    /**
     * Get user is logged
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function userAuth(Request $request)
    {
        $user = $request->user();
        $successRes = [
            'user' => new UserAuthResource($user)
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
        $user = $this->user->find($id);

        $successRes = [
            'user' => new UserResource($user),
        ];

        return new ApiStatusResource($successRes);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param App\Http\Requests\Validations\UpdateUserRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, $id)
    {
        $user = $this->user->update($request, $id);

        event(new UserUpdated($user));

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
        $user = $this->user->update($request, $id);

        event(new PasswordUpdated($user));

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
        $this->user->trash($id);

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
        $this->user->massTrash($request->ids);

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
      $this->user->destroy($id);

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
        $this->user->massDestroy($request->ids);

        $successRes = [
            'success' => trans('messages.deleted', ['model' => $this->model]),
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
        $this->user->restore($id);

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
        $this->user->massRestore($request->ids);

        $successRes = [
            'success' => trans('messages.restored', ['model' => $this->model]),
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
        $this->user->emptyTrash();

        $successRes = [
            'success' => trans('messages.deleted', ['model' => $this->model]),
        ];

        return new ApiStatusResource($successRes);
    }

}
