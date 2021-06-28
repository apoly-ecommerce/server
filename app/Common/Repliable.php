<?php

namespace App\Common;

trait Repliable
{
    /**
     * Check if model has any replies
     *
     * @return boolean
     */
    public function hasReplies() : bool
    {
        return (bool) $this->replies()->count();
    }

    /**
     * Return collection of Replies related to the replied model.
     *
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function replies()
    {
        return $this->morphOne(\App\Models\Replies::class, 'repliable');
    }
}