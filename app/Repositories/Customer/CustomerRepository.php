<?php

namespace App\Repositories\Customer;

interface CustomerRepository {

    public function profile($id);

    public function addresses($customer);

    public function saveAddress(array $address, $customer);

};