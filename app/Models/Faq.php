<?php

namespace App\Models;

class Faq extends BaseModel
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'faqs';

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * The attributes the aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * Get the Topi associated with the Faq.
     */
    public function topic()
    {
        return $this->belongsTo(FaqTopic::class, 'faq_topic_id');
    }

    /**
     * Get the question with replaced placeholder.
     *
     * @var string
     */
    public function getQuestionAttribute($question)
    {
        return str_replace([':marketplace_url', ':marketplace'], ['<a href="'. url('/') .'" target="_blank">'. url('/') .'</a>', get_platform_title()], $question);
    }

    /**
     * Get the question with replaced placeholder.
     *
     * @return string
     */
    public function getAnswerAttribute($answer)
    {
        return str_replace([':marketplace_url', 'marketplace'], ['<a href="'. url('/') .'" target="_blank">'. url('/') .'</a>', get_platform_title()], $answer);
    }
}
