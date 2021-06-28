<?php

namespace App\Models;

class FaqTopic extends BaseModel
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'faq_topics';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * Get the Faqs associated with the topic.
     */
    public function faqs()
    {
        return $this->hasMany(Faq::class, 'faq_topic_id');
    }

    /**
     * Check the Faqs associated with the topic.
     */
    public function hasFaqs() : bool
    {
        return (bool) $this->faqs()->count();
    }

    /**
     * Scope a query on only include Merchant topics.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeMerchant($query)
    {
        return $query->where('for', 'Merchant');
    }

}