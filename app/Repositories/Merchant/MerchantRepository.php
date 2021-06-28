<?php

namespace App\Repositories\Merchant;

interface MerchantRepository
{
    public function addresses($merchant);

    public function saveAddress(array $address, $merchant);
};