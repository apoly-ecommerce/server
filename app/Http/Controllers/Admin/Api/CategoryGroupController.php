<?php

namespace App\Http\Controllers\Admin\Api;

use App\Common\Authorizable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Validations\CreateCategoryGroupRequest;
use App\Http\Requests\Validations\UpdateCategoryGroupRequest;
use App\Http\Resources\ApiStatusResource;
use App\Http\Resources\CategoryGroupResource;
use App\Repositories\CategoryGroup\CategoryGroupRepository;
use Illuminate\Http\Request;

class CategoryGroupController extends Controller
{

    use Authorizable;

    protected $model;
    protected $categoryGroup;

    /**
     * construct.
     */
    public function __construct(CategoryGroupRepository $categoryGroup)
    {
        $this->model = trans('app.model.category_group');
        $this->categoryGroup = $categoryGroup;
    }

     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categoryGroups = $this->categoryGroup->all();

        $successRes = [
            'categoryGroups' => CategoryGroupResource::collection($categoryGroups),
            'status' => 200,
        ];

        return new ApiStatusResource($successRes);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function paginate(Request $request)
    {
        $categoryGroups = $this->categoryGroup->allWithPaginate($request->limit);

        $successRes = [
            'categoryGroups' => CategoryGroupResource::collection($categoryGroups),
            'total'  => $this->categoryGroup->all()->count(),
            'status' => 200,
        ];

        return new ApiStatusResource($successRes);
    }

    /**
     * Get list trashed.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function trashedPaginate(Request $request)
    {
        $categoryGroups = $this->categoryGroup->trashOnlyWithPaginate($request->limit);

        $successRes = [
            'categoryGroups' => CategoryGroupResource::collection($categoryGroups),
            'total'  => $this->categoryGroup->trashOnly()->count(),
        ];

        return new ApiStatusResource($successRes);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateCategoryGroupRequest $request)
    {
        $catGrp = $this->categoryGroup->store($request);

        $successRes = [
            'success' => trans('messages.created', ['model' => $this->model]),
            'catGrp'  => new CategoryGroupResource($catGrp),
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
        $categoryGroup = $this->categoryGroup->find($id);

        $successRes = [
            'categoryGroup' => new CategoryGroupResource($categoryGroup),
        ];

        return new ApiStatusResource($successRes);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategoryGroupRequest $request, $id)
    {
        $catGrp = $this->categoryGroup->update($request, $id);

        $successRes = [
            'success' => trans('messages.updated', ['model' => $this->model]),
            'categoryGroup' => new CategoryGroupResource($catGrp),
        ];

        return new ApiStatusResource($successRes);
    }

    /**
     * Trash the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function trash($id)
    {
        $this->categoryGroup->trash($id);

        $successRes = [
            'success' => trans('messages.trashed', ['model' => $this->model]),
        ];

        return new ApiStatusResource($successRes);
    }

    /**
     * Trash the mass resource.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function massTrash(Request $request)
    {
        $this->categoryGroup->massTrash($request->ids);

        $successRes = [
            'success' => trans('messages.trashed', ['model' => $this->model]),
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
        $this->categoryGroup->destroy($id);

        $successRes = [
            'success' => trans('messages.deleted', ['model' => $this->model]),
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
        $this->categoryGroup->massDestroy($request->ids);

        $successRes = [
            'success' => trans('messages.deleted', ['model' => $this->model]),
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
        $this->categoryGroup->restore($id);

        $successRes = [
            'success' => trans('messages.restored', ['model' => $this->model]),
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
        $this->categoryGroup->massRestore($request->ids);

        $successRes = [
            'success' => trans('messages.restored', ['model' => $this->model]),
        ];

        return new ApiStatusResource($successRes);
    }

    /**
     * Empty the Trash the mass resources.
     *
     * @return \Illuminate\Http\Response
     */
    public function emptyTrash()
    {
        $this->categoryGroup->emptyTrash();

        $successRes = [
            'success' => trans('messages.deleted', ['model' => $this->model]),
        ];

        return new ApiStatusResource($successRes);
    }

    /**
     * Export PDF
     */
    public function exportPdf()
    {
        $categories = $this->categoryGroup->all();
        $pdf = \PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadView("admin.pdf.category_group.list", $categories);
        return $pdf->download();
    }

    public function exportCsv()
    {

    }

    public function exportPrint()
    {

    }
}
