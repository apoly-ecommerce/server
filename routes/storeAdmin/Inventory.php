<?php

Route::get('inventory/setup', 'Api\InventoryController@setup')->name('inventory.setup');

Route::get('inventory/add/{product}', 'Api\InventoryController@add')->name('inventory.add');

Route::get('inventory/paginate', 'Api\InventoryController@paginate')->name('inventory.paginate');

Route::get('inventory/{inventory}/edit', 'Api\InventoryController@edit')->name('inventory.edit');

Route::get('inventory/trashed/paginate', 'Api\InventoryController@trashedPaginate')->name('inventory.trashedPaginate');

Route::delete('inventory/{inventory}/trash', 'Api\InventoryController@trash')->name('inventory.trash');

Route::delete('inventory/massTrash', 'Api\InventoryController@massTrash')->name('inventory.massTrash');

Route::patch('inventory/{inventory}/restore', 'Api\InventoryController@restore')->name('inventory.restore');

Route::patch('inventory/massRestore', 'Api\InventoryController@massRestore')->name('inventory.massRestore');

Route::delete('inventory/massDestroy', 'Api\InventoryController@massDestroy')->name('inventory.massDestroy');

Route::delete('inventory/emptyTrash', 'Api\InventoryController@emptyTrash')->name('inventory.emptyTrash');

Route::apiResource('inventory', 'Api\InventoryController');