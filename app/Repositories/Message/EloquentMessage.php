<?php

use App\Repositories\BaseRepository;
use App\Repositories\EloquentRepository;

class EloquentMessage extends EloquentRepository implements BaseRepository, MessageRepository
{
   protected $model;


}