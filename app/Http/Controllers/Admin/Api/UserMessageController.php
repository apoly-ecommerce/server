<?php

namespace App\Http\Controllers\Admin\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ApiStatusResource;
use App\Http\Resources\FriendResource;
use App\Repositories\UserMessage\UserMessageRepository;
use Illuminate\Http\Request;

class UserMessageController extends Controller
{

    private $model;
    private $userMessage;

    public function __construct(UserMessageRepository $userMessage)
    {
        $this->model = trans('app.model.userMessage');
        $this->userMessage = $userMessage;
    }

    public function friends()
    {
        $friends = $this->userMessage->friends();

        $successRes = [
            'friends' => FriendResource::collection($friends)
        ];

        return new ApiStatusResource($successRes);
    }
}