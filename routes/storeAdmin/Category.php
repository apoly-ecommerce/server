<?php

Route::post('category/add', 'Api\CategoryController@store')->name('category.store');
Route::get('category/list', 'Api\CategoryController@index')->name('category.index');
Route::get('category/list/paginate', 'Api\CategoryController@allPaginate')->name('category.allPaginate');
Route::get('category/list/trashed/paginate', 'Api\CategoryController@allTrashedPaginate')->name('category.allTrashedPaginate');
Route::get('category/show/{id}', 'Api\CategoryController@show')->name('category.show');
Route::delete('category/trash/{id}', 'Api\CategoryController@trash')->name('category.trash');
Route::delete('category/massTrash', 'Api\CategoryController@massTrash')->name('category.massTrash');
Route::delete('category/destroy/{id}', 'Api\CategoryController@destroy')->name('category.destroy');
Route::delete('category/massDestroy', 'Api\CategoryController@massDestroy')->name('category.massDestroy');
Route::patch('category/restore/{id}', 'Api\CategoryController@restore')->name('category.restore');
Route::patch('category/massRestore', 'Api\CategoryController@massRestore')->name('category.massRestore');
Route::put('category/update/{id}', 'Api\CategoryController@update')->name('category.update');