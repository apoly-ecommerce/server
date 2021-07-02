<?php
// Inventories
Route::get('inventory/add/{product}', 'Api\InventoryController@add')->name('inventory.add');
Route::apiResource('inventory', 'Api\InventoryController', ['store', 'update', 'store']);