<?php

namespace App\Http\Controllers\Admin\Api;

use Auth;
use App\Http\Controllers\Controller;
use App\Http\Resources\ApiStatusResource;
use App\Http\Resources\NotificationResource;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    private $model;

    public function __construct()
    {
        $this->model = trans('app.model.notification');
    }

    public function notifications()
    {
        $notifications = Auth::user()->notifications;

        $successRes = [
            'notifications' => NotificationResource::collection($notifications)
        ];

        return new ApiStatusResource($successRes);
    }

    /**
     * Show the notifications for the current user.
     *
     * @return \Illuminate\Http\Response
     */
    public function unreadNotifications()
    {
        $notifications = Auth::user()->unreadNotifications;

        $successRes = [
            'notifications' => NotificationResource::collection($notifications)
        ];

        return new ApiStatusResource($successRes);
    }

    /**
     * Mark all notifications As Read.
     *
     * @return \Illuminate\Http\Response
     */
    public function markAllNotificationsAsRead()
    {
        Auth::user()->unreadNotifications->markAsRead();

        return new ApiStatusResource('success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Auth::user()->notifications()->find($id)->delete();

        $successRes = [
            'success' => trans('messages.deleted', ['model' => $this->model]),
        ];

        return new ApiStatusResource($successRes);
    }

    /**
     * Remove all the resources.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroyAll()
    {
        Auth::user()->notifications()->delete();

        $successRes = [
            'success' => trans('messages.deleted', ['model' => $this->model]),
        ];

        return new ApiStatusResource($successRes);
    }
}