<?php

namespace App\Repositories\User;

use Auth;
use App\User;
use App\Repositories\BaseRepository;
use App\Repositories\EloquentRepository;
use Illuminate\Http\Request;

class EloquentUser extends EloquentRepository implements BaseRepository, UserRepository
{

    protected $model;

    public function __construct(User $user)
    {
        $this->model = $user;
    }

    public function allWithPaginate($limit)
    {
        if (! Auth::user()->isFromPlatform()) {
            return $this->model->level()->mine()->with('role', 'shop', 'image', 'primaryAddress')->paginate($limit);
        }
        return $this->model->level()->fromPlatform()->with('role', 'shop', 'image', 'primaryAddress')->paginate($limit);
    }

    public function trashOnlyWithPaginate($limit)
    {
        if (! Auth::user()->isFromPlatform()) {
            return $this->model->level()->mine()->onlyTrashed()->with('role', 'shop', 'image', 'primaryAddress')->paginate($limit);
        }
        return $this->model->level()->fromPlatform()->onlyTrashed()->with('role', 'shop', 'image', 'primaryAddress')->paginate($limit);
    }

    public function addresses($user)
    {
        return $user->addresses()->get();
    }

    public function store(Request $request)
    {
        $user = parent::store($request);

        $this->saveAddress($request->all(), $user);

        if ($request->hasFile('image')) {
            $user->saveImage($request->file('image'));
        }

        return $user;
    }

    public function saveAddress(array $address, $user)
    {
        $user->addresses()->create($address);
    }

    public function update(Request $request, $id)
    {
        $user = parent::update($request, $id);

        if ($request->hasFile('image') || ($request->input('delete_avatar') == '1')) {
            $user->deleteImage();
        }

        if ($request->hasFile('image')) {
            $user->saveImage($request->file('image'));
        }

        return $user;
    }

    public function destroy($id)
    {
        $user = parent::findTrash($id);

        $user->flushAddresses();

        $user->flushImages();

        return $user->forceDelete();
    }

    public function massDestroy($ids)
    {
        $users = $this->model->withTrashed()->whereIn('id', $ids)->get();

        foreach ($users as $user){
            $user->flushAddresses();
            $user->flushImages();
        }

        return parent::massDestroy($ids);
    }

    public function emptyTrash()
    {
        $users = $this->model->onlyTrashed()->get();

        foreach ($users as $user){
            $user->flushAddresses();
            $user->flushImages();
        }

        return parent::emptyTrash();
    }

}