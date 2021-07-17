<?php

namespace App\Http\Controllers\Admin\Api;

use Pusher\Pusher;
use App\Http\Controllers\Controller;
use App\Http\Resources\ApiStatusResource;
use Illuminate\Http\Request;

class PusherController extends Controller
{
    /**
     * Authenticates logged-in user in the pusher JS app
     * For presence channels
     */
    public function pusherAuth(Request $request)
    {
        $user = $request->user();

        if ($user) {

            $presenceData = [
                'user_id' => $user->id,
                'user_info' => [
                    'name' => $user->name,
                    'email' => $user->email,
                ]
            ];

            $pusher = new Pusher(
                config('broadcasting.connections.pusher.key'),
                config('broadcasting.connections.pusher.secret'),
                config('broadcasting.connections.pusher.app_id'),
                [
                    'cluster' => config('broadcasting.connections.pusher.options.cluster'),
                ],
            );

            $payload = $pusher->presence_auth($request->channel_name, $request->socket_id, $presenceData);

            return $payload;
        }
        else {
            $failedRes = [
                'error' => 'Forbidden',
            ];
            return (new ApiStatusResource($failedRes))->setStatusCode(403);
        }
    }
}