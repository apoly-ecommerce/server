<?php

namespace App\Repositories\User;

interface UserRepository
{
    public function addresses($user);

    public function saveAddress(array $address, $user);
};