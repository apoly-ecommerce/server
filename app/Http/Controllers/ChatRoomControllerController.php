<?php

namespace App\Http\Controllers;

use App\Admin\Api\ChatRoomController;
use App\Http\Resources\ApiStatusResource;
use App\Repositories\ChatRoom\ChatRoomRepository;
use Illuminate\Http\Request;

class ChatRoomControllerController extends Controller
{
    protected $model;
    protected $chatRoom;

    /**
     * Construct
     *
     * @param App\Repositories\ChatRoom\ChatRoomRepository $chatRoom
     * @return void
     */
    public function __construct(ChatRoomRepository $chatRoom)
    {
        $this->model = trans('app.model.chatRoom');
        $this->chatRoom = $chatRoom;
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->chatRoom->store($request);

        $successRes = [
            'success' => trans('messages.created', ['model' => $this->model]),
        ];

        return new ApiStatusResource($successRes);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Admin\Api\ChatRoomController  $chatRoomController
     * @return \Illuminate\Http\Response
     */
    public function show(ChatRoomController $chatRoomController)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Admin\Api\ChatRoomController  $chatRoomController
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ChatRoomController $chatRoomController)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Admin\Api\ChatRoomController  $chatRoomController
     * @return \Illuminate\Http\Response
     */
    public function destroy(ChatRoomController $chatRoomController)
    {
        //
    }
}
