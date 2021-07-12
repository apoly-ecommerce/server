<?php

Route::get('category/setup', 'Api\CategoryController@setup')->name('category.setup');

Route::get('category/paginate', 'Api\CategoryController@paginate')->name('category.paginate');

Route::get('category/trashed/paginate', 'Api\CategoryController@trashedPaginate')->name('category.trashedPaginate');

Route::delete('category/{category}/trash', 'Api\CategoryController@trash')->name('category.trash');

Route::delete('category/massTrash', 'Api\CategoryController@massTrash')->name('category.massTrash');

Route::patch('category/{category}/restore', 'Api\CategoryController@restore')->name('category.restore');

Route::patch('category/massRestore', 'Api\CategoryController@massRestore')->name('category.massRestore');

Route::delete('category/massDestroy', 'Api\CategoryController@massDestroy')->name('category.massDestroy');

Route::delete('category/emptyTrash', 'Api\CategoryController@emptyTrash')->name('category.emptyTrash');

Route::delete('category/emptyTrash', 'Api\CategoryController@emptyTrash')->name('category.emptyTrash');

Route::apiResource('category', 'Api\CategoryController');