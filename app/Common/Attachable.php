<?php

namespace App\Common;

use Auth;

trait Attachable
{
    /**
     * Check if model has any Attachments
     *
     * @return bool
     */
    public function hasAttachments()
    {
        return (bool) $this->attachments()->count();
    }

    /**
     * Return collections of the Attachments related to the model
     *
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function attachments()
    {
        return $this->morphOne(\App\Models\Attachment::class, 'attachable');
    }

    /**
     * Return collection of the Attachments related to the user/customer
     *
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function files()
    {
        return $this->morphMany(\App\Attachment::class, 'ownable');
    }

    /**
     * Save Attachments
     *
     * @param \Illuminate\Http\Request $request
     * @param model $attachable
     *
     * @return attachment model
     */
    public function saveAttachments()
    {
        $data = [];
        $dir = attachment_storage_dir();

        $ownable['ownable_id'] = Auth::user()->id;
        $ownable['ownable_type'] = Auth::guard('customer')->check() ? 'App\Models\Customer' : 'App\User';

    }
}