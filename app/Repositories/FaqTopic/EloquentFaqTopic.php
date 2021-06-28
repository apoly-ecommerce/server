<?php

namespace App\Repositories\FaqTopic;

use App\Models\FaqTopic;
use App\Repositories\BaseRepository;
use App\Repositories\EloquentRepository;

class EloquentFaqTopic extends EloquentRepository implements BaseRepository, FaqTopicRepository
{
    protected $model;

    public function __construct(FaqTopic $faqTopic)
    {
        $this->model = $faqTopic;
    }

    public function all()
    {
        return $this->model->get();
    }
}