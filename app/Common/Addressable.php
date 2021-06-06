<?php

namespace App\Common;

/**
 * Attach this Trait to a User (or other model) for easier read/writes on address.
 *
 * @author PhamDinhHung <phamdinhhung2k1.it@gmail.com>
 */
trait Addressable
{
    /**
     * Check if model has an address.
     *
     * @return bool
     */
    public function hasAddress() : bool
    {
        return $this->address()->count();
    }
}