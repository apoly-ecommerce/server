<?php

Route::get('product/paginate', 'Api\ProductController@paginate')->name('product.paginate');

Route::get('product/trashed/paginate', 'Api\ProductController@trashedPaginate')->name('product.trashedPaginate');

Route::delete('product/{product}/trash', 'Api\ProductController@trash')->name('product.trash');

Route::delete('product/massTrash', 'Api\ProductController@massTrash')->name('product.massTrash');

Route::patch('product/{product}/restore', 'Api\ProductController@restore')->name('product.restore');

Route::patch('product/massRestore', 'Api\ProductController@massRestore')->name('product.massRestore');

Route::delete('product/massDestroy', 'Api\ProductController@massDestroy')->name('product.massDestroy');

Route::delete('product/emptyTrash', 'Api\ProductController@emptyTrash')->name('product.emptyTrash');

Route::apiResource('product', 'Api\ProductController');