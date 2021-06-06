<?php

Route::post('product/add', 'Api\ProductController@store')->name('product.store');
Route::get('product/list', 'Api\ProductController@index')->name('product.index');
Route::get('product/list/paginate', 'Api\ProductController@allPaginate')->name('product.allPaginate');
Route::get('product/list/trashed/paginate', 'Api\ProductController@allTrashedPaginate')->name('product.allTrashedPaginate');
Route::get('product/show/{id}', 'Api\ProductController@show')->name('product.show');
Route::delete('product/trash/{id}', 'Api\ProductController@trash')->name('product.trash');
Route::delete('product/massTrash', 'Api\ProductController@massTrash')->name('product.massTrash');
Route::delete('product/destroy/{id}', 'Api\ProductController@destroy')->name('product.destroy');
Route::delete('product/massDestroy', 'Api\ProductController@massDestroy')->name('product.massDestroy');
Route::delete('product/emptyTrash', 'Api\ProductController@emptyTrash')->name('product.emptyTrash');
Route::patch('product/restore/{id}', 'Api\ProductController@restore')->name('product.restore');
Route::patch('product/massRestore', 'Api\ProductController@massRestore')->name('product.massRestore');
Route::put('product/update/{id}', 'Api\ProductController@update')->name('product.update');