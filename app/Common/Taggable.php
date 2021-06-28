<?php

namespace App\Common;

trait Taggable
{
    /**
     * Get all of the tags for the model.
     */
    public function tags()
    {
        return $this->morphToMany(\App\Models\Tag::class, 'taggable');
    }

    /**
     * Sync up the tags the taggable model and create new tags if not exist
     *
     * @param \App\Models\Tag $taggable
     * @param array $tagIds
     *
     * @return void
     */
    public function syncTags($taggable, array $tagIds)
    {
        $tags = [];
        foreach ($tagIds as $id) {
            if (is_numeric($id)) {
                $tags[] = $id;
            } else {
                // if the tag not numeric the mean the its new tag and we should create it
                $newTag = \App\Models\Tag::firstOrCreate(['name' => $id]);
                $tags[] = $newTag->id;
            }
        }

        return $taggable->tags()->sync($tags);
    }

    /**
     * Detach all tags for the taggable model.
     *
     * @param int $id
     * @param string $taggable
     * @return void
     */
    public function detachTags($id, $taggable)
    {
        $taggable_type = get_qualified_model($taggable);

        return \DB::table('taggables')
                ->where('taggable_id', $id)
                ->where('taggable_type', $taggable_type)
                ->delete();
    }
}