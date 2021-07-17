<?php

namespace App\Http\Controllers\Admin\Api;

use App\Events\Message\ChatRoomCreated;
use App\Repositories\ChatRoom\ChatRoomRepository;
use App\Http\Resources\ApiStatusResource;
use App\Http\Controllers\Controller;
use App\Http\Requests\Validations\CreateChatRoomRequest;
use App\Http\Resources\ChatRoomResource;
use Illuminate\Http\Request;

class ChatRoomController extends Controller
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
        $rooms = $this->chatRoom->all();

        $successRes = [
            'rooms' => ChatRoomResource::collection($rooms)
        ];

        return new ApiStatusResource($successRes);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateChatRoomRequest $request)
    {
        $chatRoom = $this->chatRoom->store($request);

        broadcast(new ChatRoomCreated($chatRoom));

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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
