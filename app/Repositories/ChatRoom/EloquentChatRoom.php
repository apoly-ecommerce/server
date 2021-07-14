<?php

namespace App\Repositories\ChatRoom;

use Auth;
use App\Models\ChatRoom;
use Illuminate\Http\Request;
use App\Repositories\BaseRepository;
use App\Repositories\EloquentRepository;

class EloquentChatRoom extends EloquentRepository implements BaseRepository, ChatRoomRepository
{

    protected $model;

    public function __construct(ChatRoom $chatRoom)
    {
        $this->model = $chatRoom;
    }


    public function all()
    {
        return Auth::user()->chatRooms()->get();
    }

    public function store(Request $request)
    {
        $chatRoom = parent::store($request);

        if ($request->input('user_list')) {
            $chatRoom->users()->sync($request->input('user_list'));
        }

        if ($request->hasFile('image')) {
          $chatRoom->saveImage($request->file('image'));
      }

        return $chatRoom;
    }
}