<?php

namespace App\Repositories\UserMessage;

use Auth;
use App\Models\UserMessage;
use App\Repositories\BaseRepository;
use App\Repositories\EloquentRepository;
use Illuminate\Http\Request;

class EloquentUserMessage extends EloquentRepository implements BaseRepository, UserMessageRepository
{

    protected $model;

    public function __construct(UserMessage $userMessage)
    {
        $this->model = $userMessage;
    }

    public function friends()
    {
        if (! Auth::user()->isFromPlatform()) {
            return Auth::user()->mine()->where('id', '!=', Auth::id())->with('shop', 'image', 'role')->get();
        }

        return  Auth::user()->where('id', '!=', Auth::id())->fromPlatform()->with('shop', 'image', 'role')->get();
    }

    public function messages(Request $request, $source_id, $target_id)
    {
        return $this->userMessage->where([
            ['source_id', $source_id],
            ['target_id', $target_id]
        ])->orderBy('created_at', 'desc');
    }

}