<?php

Route::get('banner/paginate', 'Api\BannerController@paginate')->name('banner.paginate');
Route::get('banner/trashed/paginate', 'Api\BannerController@trashedPaginate')->name('banner.trashedPaginate');
Route::delete('banner/{banner}/trash', 'Api\BannerController@trash')->name('banner.trash');
Route::delete('banner/massTrash', 'Api\BannerController@massTrash')->name('banner.massTrash');
Route::patch('banner/{banner}/restore', 'Api\BannerController@restore')->name('banner.restore');
Route::patch('banner/massRestore', 'Api\BannerController@massRestore')->name('banner.massRestore');
Route::delete('banner/massDestroy', 'Api\BannerController@massDestroy')->name('banner.massDestroy');
Route::delete('banner/emptyTrash', 'Api\BannerController@emptyTrash')->name('banner.emptyTrash');
Route::apiResource('banner', 'Api\BannerController');