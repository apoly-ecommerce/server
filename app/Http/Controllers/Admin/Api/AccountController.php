<?php

namespace App\Http\Controllers\Admin\Api;

use App\Events\Profile\PasswordUpdated;
use Auth;
use App\Events\Profile\ProfileUpdated;
use App\Http\Controllers\Controller;
use App\Http\Requests\Validations\UpdatePasswordRequest;
use App\Http\Requests\Validations\UpdatePhotoRequest;
use App\Http\Requests\Validations\UpdateProfileRequest;
use App\Http\Resources\ApiStatusResource;
use App\Http\Resources\ProfileResource;
use App\Repositories\Account\AccountRepository;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    private $model;
    private $profile;

    /**
     * Construct
     */
    public function __construct(AccountRepository $profile)
    {
        $this->model = trans('app.model.profile');
        $this->profile = $profile;
    }

    /**
     * Show the profile.
     *
     * @return \Illuminate\Http\Response
     */
    public function profile()
    {
        $profile = $this->profile->profile();

        $successRes = [
            'profile' => new ProfileResource($profile)
        ];

        return new ApiStatusResource($successRes);
    }

    /**
     * Update Photo only.
     *
     * @param \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updatePhoto(UpdatePhotoRequest $request)
    {
        $this->profile->updatePhoto($request);

        $successRes = [
            'success' => trans('messages.photo_profile_updated'),
        ];

        return new ApiStatusResource($successRes);
    }

    /**
     * Remove photo from resource.
     *
     * @param \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function deletePhoto(Request $request)
    {
        $this->profile->deletePhoto($request);

        $successRes = [
            'success' => trans('messages.photo_profile_deleted'),
        ];

        return new ApiStatusResource($successRes);
    }

    /**
     * Update profile information.
     *
     * @param \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProfileRequest $request)
    {
        $this->profile->updateProfile($request);

        event(new ProfileUpdated(Auth::user()));

        $successRes = [
            'success' => trans('messages.profile_updated')
        ];

        return new ApiStatusResource($successRes);
    }

    /**
     * Update login password only.
     *
     * @param \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updatePassword(UpdatePasswordRequest $request)
    {
        $this->profile->updatePassword($request);

        event(new PasswordUpdated(Auth::user()));

        $successRes = [
            'success' => trans('messages.password_updated')
        ];

        return new ApiStatusResource($successRes);
    }
}