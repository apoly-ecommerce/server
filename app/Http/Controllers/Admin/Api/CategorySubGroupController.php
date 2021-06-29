<?php

namespace App\Http\Controllers\Admin\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Validations\CreateCategorySubGroupRequest;
use App\Http\Requests\Validations\UpdateCategorySubGroupRequest;
use App\Http\Resources\ApiStatusResource;
use App\Http\Resources\CategorySubGroupResource;
use App\Repositories\CategorySubGroup\CategorySubGroupRepository;
use Illuminate\Http\Request;

class CategorySubGroupController extends Controller
{

    protected $model;
    protected $categorySubGroup;

    public function __construct(CategorySubGroupRepository $categorySubGroup)
    {
        $this->model = trans('app.model.category_sub_group');
        $this->categorySubGroup = $categorySubGroup;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categorySubGroups = $this->categorySubGroup->all();

        $successRes = [
            'categorySubGroups' => CategorySubGroupResource::collection($categorySubGroups),
            'status' => 200,
        ];

        return new ApiStatusResource($successRes);
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function paginate(Request $request)
    {
        $categorySubGroup = $this->categorySubGroup->allWithPaginate($request->limit);

        $successRes = [
            'categorySubGroups' => CategorySubGroupResource::collection($categorySubGroup),
            'total'  => $this->categorySubGroup->all()->count(),
            'status' => 200
        ];

        return new ApiStatusResource($successRes);
    }

    /**
     * Display a listing trashed of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function trashedPaginate(Request $request)
    {
        $categorySubGroups = $this->categorySubGroup->trashOnlyWithPaginate($request->limit);

        $successRes = [
            'categorySubGroups' => CategorySubGroupResource::collection($categorySubGroups),
            'total'  => $this->categorySubGroup->trashOnly()->count(),
            'status' => 200,
        ];

        return new ApiStatusResource($successRes);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\CreateCategorySubGroupRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateCategorySubGroupRequest $request)
    {
        $catSubGrp = $this->categorySubGroup->store($request);

        $successRes = [
            'success' => trans('messages.created', ['model' => $this->model]),
            'categorySubGroup' => new CategorySubGroupResource($catSubGrp),
            'status' => 200
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
      $catSubGrp = $this->categorySubGroup->find($id);

      $successRes = [
          'categorySubGroup' => new CategorySubGroupResource($catSubGrp),
          'status' => 200
      ];

      return new ApiStatusResource($successRes);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\UpdateCategorySubGroupRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategorySubGroupRequest $request, $id)
    {
        $catSubGrp = $this->categorySubGroup->update($request, $id);

        $successRes = [
            'success' => trans('messages.updated', ['model' => $this->model]),
            'categorySubGroup' => new CategorySubGroupResource($catSubGrp),
            'status' => 200
        ];

        return new ApiStatusResource($successRes);
    }

    /**
     * Trash the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function trash($id)
    {
        $this->categorySubGroup->trash($id);

        $successRes = [
            'success' => trans('messages.trashed', ['model' => $this->model]),
            'status'  => 200
        ];

        return new ApiStatusResource($successRes);
    }

    /**
     * Trash the mass resources.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function massTrash(Request $request)
    {
        $this->categorySubGroup->massTrash($request->ids);

        $successRes = [
            'success' => trans('messages.trashed', ['model' => $this->model]),
            'status'  => 200
        ];

        return new ApiStatusResource($successRes);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $this->categorySubGroup->destroy($id);

      $successRes = [
          'success' => trans('messages.deleted', ['model' => $this->model]),
          'status'  => 200
      ];

      return new ApiStatusResource($successRes);
    }

    /**
     * Destroy the mass resources.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function massDestroy(Request $request)
    {
        $this->categorySubGroup->massDestroy($request->ids);

        $successRes = [
            'success' => trans('messages.deleted', ['model' => $this->model]),
            'status'  => 200
        ];

        return new ApiStatusResource($successRes);
    }

    /**
     * Restore the specified resource from soft delete.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        $this->categorySubGroup->restore($id);

        $successRes = [
            'success' => trans('messages.restored', ['model' => $this->model]),
            'status'  => 200
        ];

        return new ApiStatusResource($successRes);
    }

    /**
     * Restore the mass resources.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function massRestore(Request $request)
    {
        $this->categorySubGroup->massRestore($request->ids);

        $successRes = [
            'success' => trans('messages.restored', ['model' => $this->model]),
            'status'  => 200
        ];

        return new ApiStatusResource($successRes);
    }
}
