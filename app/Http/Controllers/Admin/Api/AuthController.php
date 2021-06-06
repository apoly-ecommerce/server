<?php

namespace App\Http\Controllers\Admin\Api;

use Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\Validations\AuthUserLoginRequest;
use App\Http\Resources\ApiStatusResource;
use Illuminate\Http\Request;

class AuthController extends Controller
{
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
