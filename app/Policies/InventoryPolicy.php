<?php

namespace App\Policies;

use App\User;
use App\Models\Inventory;
use App\Helpers\Authorize;
use Illuminate\Auth\Access\HandlesAuthorization;

class InventoryPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view Inventories.
     *
     * @param \App\User  $user
     * @return mixed
     */
    public function index(User $user)
    {
        return (new Authorize($user, 'view_inventory'))->check();
    }

    /**
     * Determine whether the user can view the Inventory.
     *
     * @param \App\User  $user
     * @param \App\Models\Inventory  $inventory
     * @return  mixed
     */
    public function view(User $user, Inventory $inventory)
    {
        return (new Authorize($user, 'view_inventory', $inventory))->check();
    }

    /**
     * Determine whether the user can create Inventory.
     *
     * @param \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return (new Authorize($user, 'add_inventory'))->check();
    }

    /**
     * Determine whether the user can update the Inventory.
     *
     * @param \App\User  $user
     * @param \App\Models\Inventory  $inventory
     * @return mixed
     */
    public function update(User $user, Inventory $inventory)
    {
        return (new Authorize($user, 'edit_inventory', $inventory))->check();
    }

    /**
     * Determine whether the user can delete the Inventory.
     *
     * @param \App\User  $user
     * @param \App\Models\Inventory  $inventory
     * @return mixed
     */
    public function delete(User $user, Inventory $inventory)
    {
        return (new Authorize($user, 'delete_inventory', $inventory))->check();
    }

    /**
     * Determine whether the user can massDelete the Inventory.
     *
     * @param \App\User  $user
     * @return mixed
     */
    public function massDelete(User $user)
    {
        return (new Authorize($user, 'delete_inventory'))->check();
    }

}