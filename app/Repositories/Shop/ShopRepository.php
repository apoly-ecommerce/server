<?php

namespace App\Repositories\Shop;

interface ShopRepository
{
    public function staffs($shop);

    public function staffTrashOnly($shop);

    public function saveAddress(array $address, $shop);
};