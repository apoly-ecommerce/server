<?php

Route::get('manufacturer/paginate', 'Api\ManufacturerController@paginate')->name('manufacturer.paginate');

Route::get('manufacturer/trashed/paginate', 'Api\ManufacturerController@trashedPaginate')->name('manufacturer.trashedPaginate');

Route::delete('manufacturer/{manufacturer}/trash', 'Api\ManufacturerController@trash')->name('manufacturer.trash');

Route::delete('manufacturer/massTrash', 'Api\ManufacturerController@massTrash')->name('manufacturer.massTrash');

Route::patch('manufacturer/{manufacturer}/restore', 'Api\ManufacturerController@restore')->name('manufacturer.restore');

Route::patch('manufacturer/massRestore', 'Api\ManufacturerController@massRestore')->name('manufacturer.massRestore');

Route::delete('manufacturer/massDestroy', 'Api\ManufacturerController@massDestroy')->name('manufacturer.massDestroy');

Route::delete('manufacturer/emptyTrash', 'Api\ManufacturerController@emptyTrash')->name('manufacturer.emptyTrash');

Route::apiResource('manufacturer', 'Api\ManufacturerController');