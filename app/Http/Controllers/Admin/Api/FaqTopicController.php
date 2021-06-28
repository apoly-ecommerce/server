<?php

namespace App\Http\Controllers\Admin\Api;

use App\Models\FaqTopic;
use App\Common\Authorizable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Validations\CreateFaqTopicRequest;
use App\Http\Requests\Validations\UpdateFaqTopicRequest;
use App\Http\Resources\FaqTopicResource;
use App\Http\Resources\ApiStatusResource;
use App\Repositories\FaqTopic\FaqTopicRepository;
use Illuminate\Http\Request;

class FaqTopicController extends Controller
{
    use Authorizable;

    protected $model;
    protected $faqTopic;

    /**
     * Constructor.
     */
    public function __construct(FaqTopicRepository $faqTopic)
    {
        $this->model = trans('app.model.faqTopic');
        $this->faqTopic = $faqTopic;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $faqTopics = $this->faqTopic->all();

        $successRes = [
            'faqTopics' => FaqTopicResource::collection($faqTopics),
        ];

        return new ApiStatusResource($successRes);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateFaqTopicRequest $request)
    {
        $this->faqTopic->store($request);

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
        $faqTopic = $this->faqTopic->find($id);

        $successRes = [
            'faqTopic' => new FaqTopicResource($faqTopic)
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
    public function update(UpdateFaqTopicRequest $request, $id)
    {
        $this->faqTopic->update($request, $id);

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
        $topic = FaqTopic::findOrFail($id);

        if ($topic->hasFaqs()) {
            return (new ApiStatusResource([
                'error' => trans('messages.cant_delete_faq_topic', ['topic' => $topic->name])
            ]))->setStatusCode(422);
        }

        $topic->forceDelete();

        return new ApiStatusResource([
            'success' => trans('messages.deleted', ['model' => $this->model])
        ]);
    }
}