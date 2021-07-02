<?php

namespace App\Repositories\Inventory;

interface InventoryRepository
{
    public function findProduct($id);

    public function checkInventoryExists($productId);
};