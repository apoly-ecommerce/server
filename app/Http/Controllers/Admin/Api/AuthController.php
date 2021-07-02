<?php

namespace App\Http\Controllers\Admin\Api;

use Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\Validations\AuthUserLoginRequest;
use App\Http\Resources\ApiStatusResource;
use App\Http\Resources\UserAuthResource;
use App\Models\Module;
use Illuminate\Http\Request;

class AuthController extends Controller
{

    /**
     * Get user is logged
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function user(Request $request)
    {
        $user = $request->user();

        $successRes = [
            'user' => new UserAuthResource($user),
        ];

        return new ApiStatusResource($successRes);
    }

    public function register(Request $request)
    {

    }


    public function login(AuthUserLoginRequest $request)
    {
        $credentials = [
            'email'    => $request->email,
            'password' => $request->password
        ];

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $token = $user->createToken('access_token')->accessToken;
            $successRes = [
                'accessToken' => $token,
                'status' => 200
            ];
            return new ApiStatusResource($successRes);
        }

        $failedRes = [
            'errors' => ['account' => trans('api.auth_failed')],
            'status' => 422
        ];
        return (new ApiStatusResource($failedRes))->setStatusCode(422);
    }

    public function logout(Request $request)
    {
        $user = $request->user();
        if ($user) {
            $user->token()->revoke();
            $successRes = [
                'success' => trans('api.auth_out'),
                'status'  => 200
            ];
            return new ApiStatusResource($successRes);
        }
    }
}
