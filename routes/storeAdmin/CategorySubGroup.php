<?php

Route::post('categorySubGroup/add', 'Api\CategorySubGroupController@store')->name('categorySubGroup.store');
Route::get('categorySubGroup/list', 'Api\CategorySubGroupController@index')->name('categorySubGroup.index');
Route::get('categorySubGroup/list/paginate', 'Api\CategorySubGroupController@allPaginate')->name('categorySubGroup.allPaginate');
Route::get('categorySubGroup/list/trashed/paginate', 'Api\CategorySubGroupController@allTrashedPaginate')->name('categorySubGroup.allTrashedPaginate');
Route::get('categorySubGroup/show/{id}', 'Api\CategorySubGroupController@show')->name('categorySubGroup.show');
Route::delete('categorySubGroup/trash/{id}', 'Api\CategorySubGroupController@trash')->name('categorySubGroup.trash');
Route::delete('categorySubGroup/massTrash', 'Api\CategorySubGroupController@massTrash')->name('categorySubGroup.massTrash');
Route::delete('categorySubGroup/destroy/{id}', 'Api\CategorySubGroupController@destroy')->name('categorySubGroup.destroy');
Route::delete('categorySubGroup/massDestroy', 'Api\CategorySubGroupController@massDestroy')->name('categorySubGroup.massDestroy');
Route::patch('categorySubGroup/restore/{id}', 'Api\CategorySubGroupController@restore')->name('categorySubGroup.restore');
Route::patch('categorySubGroup/massRestore', 'Api\CategorySubGroupController@massRestore')->name('categorySubGroup.massRestore');
Route::put('categorySubGroup/update/{id}', 'Api\CategorySubGroupController@update')->name('categorySubGroup.update');