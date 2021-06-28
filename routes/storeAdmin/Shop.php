<?php

Route::get('shop/paginate', 'Api\ShopController@paginate')->name('shop.paginate');
Route::get('shop/trashed/paginate', 'Api\ShopController@trashedPaginate')->name('shop.trashedPaginate');
Route::delete('shop/{shop}/trash', 'Api\ShopController@trash')->name('shop.trash');
Route::patch('shop/{shop}/restore', 'Api\ShopController@restore')->name('shop.restore');
Route::delete('shop/massTrash', 'Api\ShopController@massTrash')->name('shop.massTrash');
Route::patch('shop/massRestore', 'Api\ShopController@massRestore')->name('shop.massRestore');
Route::delete('shop/massDestroy', 'Api\ShopController@massDestroy')->name('shop.massDestroy');
Route::delete('shop/emptyTrash', 'Api\ShopController@emptyTrash')->name('shop.emptyTrash');
Route::apiResource('shop', 'Api\ShopController', ['except' => ['create', 'store']]);