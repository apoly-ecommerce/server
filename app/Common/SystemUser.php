<?php

namespace App\Common;

use App\User;
use App\Models\Role;

trait SystemUser
{
    /**
     * Get the super admin who owns the marketplace.
     */
    public function superAdmin()
    {
        return User::where('role_id', Role::SUPER_ADMIN)->first();
    }

    /**
     * Get all admin users of the marketplaces.
     */
    public function admins()
    {
        return User::whereIn('role_id', [Role::SUPER_ADMIN, Role::ADMIN])->get();
    }

    /**
     * Get all merchant users of the marketplaces.
     */
    public function merchants()
    {
        return User::where('role_id', Role::MERCHANT)->get();
    }
}