<?php

namespace App\Http\Controllers\Admin\Api;

use Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\Validations\AuthUserLoginRequest;
use App\Http\Resources\ApiStatusResource;
use App\Http\Resources\UserAuthResource;
use App\Models\Module;
use Illuminate\Http\Request;
use Pusher\Pusher;

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

    public function broadcasting(Request $request)
    {
        $user = $request->user();

        $presenceData = [
            'user_id' => $user->id,
            'user_info' => [
                'name' => $user->name,
                'email' => $user->email,
            ]
        ];

        // $auth = Pusher::presence_auth($request->channel_name, $request->socket_id, $presenceData);
        $pusher = new Pusher(
            env('PUSHER_APP_KEY'),
            env('PUSHER_APP_SECRET'),
            env('PUSHER_APP_ID'),
            [
                'cluster' => env('PUSHER_APP_CLUSTER'),
            ],
        );

        $auth = $pusher->presence_auth($request->channel_name, $request->socket_id, $presenceData);

        $successRes = [
            'auth' => $auth,
        ];

        // return new ApiStatusResource($successRes);
        return $auth;

    }
}