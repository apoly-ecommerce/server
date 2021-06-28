<?php

namespace App\Repositories\Faq;

use App\Models\Faq;
use App\Repositories\BaseRepository;
use App\Repositories\EloquentRepository;

class EloquentFaq extends EloquentRepository implements BaseRepository, FaqRepository
{
    protected $model;

    public function __construct(Faq $faq)
    {
        $this->model = $faq;
    }

    public function allWithPaginate($limit)
    {
        return $this->model->with('topic')->paginate($limit);
    }

    public function trashOnlyWithPaginate($limit)
    {
        return $this->model->onlyTrashed()->with('topic')->paginate($limit);
    }

    public function destroy($id)
    {
        $faq = parent::find($id);

        return $faq->forceDelete();
    }
}