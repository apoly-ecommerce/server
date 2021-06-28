<?php

namespace App\Helpers;

use Auth;

/**
 * Check the action authentications.
 */
class Authorize
{
    protected $user;
    protected $model;
    protected $slug;

    public function __construct($user, $slug, $model = null)
    {
        $this->user  = $user;
        $this->model = $model;
        $this->slug  = $slug;
    }

    /**
     * Check authorization.
     *
     * @return bool
     */
    public function check() : bool
    {

        // Application user.
        if ($this->isExceptional()) {
            return true;
        }

        // Merchant user.
        /**
         * Condition 1: shop_id field doesn't exists in table.
         * Condition 2: User access don't must is a Merchant.
         * Condition 3: User's shop_id must match Model's shop_id
         */
        if (isset($this->model)
            // Check if shop_id field is present in table element table:
            && (isset($this->model->shop_id) || array_key_exists('shop_id', $this->model))
            // Check user access is Merchant.
            && ! Auth::user()->isFromPlatform()
            // Check shop_id of user and shop_id of model
            && ! $this->merchantAuth())
        { return false; }

        return in_array($this->slug, $this->permissionSlugs());

    }

    /**
     * Check if user's shop_id and model's shop_id is same.
     *
     * @return bool
     */
    private function merchantAuth() : bool
    {
        return isset($this->model->shop_id) && $this->model->shop_id == $this->user->merchantId();
    }

    /**
     * Some case is special conditions you may allow all actions for the user.
     *
     * @return bool
     */
    private function isExceptional() : bool
    {
        // Some Routes shows personalized information and allow access.
        if (in_array($this->slug, ['dashboard', 'profile'])) {
            return true;
        }

        // The Super Admin will not required to check authorization.
        if (Auth::user()->isSuperAdmin()) {
            return true;
        }

        // The content creator always have the full permission.
        if (isset($this->model->user_id) && $this->model->user_id == $this->user->id) {
            return true;
        }

        return false;
    }

    /**
     * Get the permission from the database.
     *
     * @return array
     */
    private function permissionSlugs() : array
    {
        return $this->user->role->permissions()->pluck('slug')->toArray();
    }
}