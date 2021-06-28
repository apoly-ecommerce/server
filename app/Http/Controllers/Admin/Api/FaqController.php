<?php

namespace App\Http\Controllers\Admin\Api;

use App\Common\Authorizable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Validations\CreateFaqRequest;
use App\Http\Requests\Validations\UpdateFaqRequest;
use App\Http\Resources\ApiStatusResource;
use App\Http\Resources\FaqResource;
use App\Repositories\Faq\FaqRepository;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    use Authorizable;

    protected $model;
    protected $faq;

    public function __construct(FaqRepository $faq)
    {
        $this->model = trans('app.model.faq');
        $this->faq = $faq;
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function paginate(Request $request)
    {
        $faqs = $this->faq->allWithPaginate($request->limit);

        $successRes = [
            'faqs' => FaqResource::collection($faqs),
            'total'  => $this->faq->all()->count(),
        ];

        return new ApiStatusResource($successRes);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateFaqRequest $request)
    {
        $this->faq->store($request);

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
        $faq = $this->faq->find($id);

        $successRes = [
            'faq' => new FaqResource($faq),
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
    public function update(UpdateFaqRequest $request, $id)
    {
        $this->faq->update($request, $id);

        $successRes = [
            'success' => trans('messages.updated', ['model' => $this->model]),
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
        $this->faq->destroy($id);

        $successRes = [
            'success' => trans('messages.deleted', ['model' => $this->model]),
        ];

        return new ApiStatusResource($successRes);
    }
}
