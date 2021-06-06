<?php

Route::post('manufacturer/add', 'Api\ManufacturerController@store')->name('manufacturer.store');
Route::get('manufacturer/list', 'Api\ManufacturerController@index')->name('manufacturer.index');
Route::get('manufacturer/list/paginate', 'Api\ManufacturerController@allPaginate')->name('manufacturer.allPaginate');
Route::get('manufacturer/list/trashed/paginate', 'Api\ManufacturerController@allTrashedPaginate')->name('manufacturer.allTrashedPaginate');
Route::get('manufacturer/show/{id}', 'Api\ManufacturerController@show')->name('manufacturer.show');
Route::delete('manufacturer/trash/{id}', 'Api\ManufacturerController@trash')->name('manufacturer.trash');
Route::delete('manufacturer/massTrash', 'Api\ManufacturerController@massTrash')->name('manufacturer.massTrash');
Route::delete('manufacturer/destroy/{id}', 'Api\ManufacturerController@destroy')->name('manufacturer.destroy');
Route::delete('manufacturer/massDestroy', 'Api\ManufacturerController@massDestroy')->name('manufacturer.massDestroy');
Route::delete('manufacturer/emptyTrash', 'Api\ManufacturerController@emptyTrash')->name('manufacturer.emptyTrash');
Route::patch('manufacturer/restore/{id}', 'Api\ManufacturerController@restore')->name('manufacturer.restore');
Route::patch('manufacturer/massRestore', 'Api\ManufacturerController@massRestore')->name('manufacturer.massRestore');
Route::put('manufacturer/update/{id}', 'Api\ManufacturerController@update')->name('manufacturer.update');