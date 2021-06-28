<?php

Route::get('slider/paginate', 'Api\SliderController@paginate')->name('slider.paginate');
Route::get('slider/trashed/paginate', 'Api\SliderController@trashedPaginate')->name('slider.trashedPaginate');
Route::delete('slider/{slider}/trash', 'Api\SliderController@trash')->name('slider.trash');
Route::delete('slider/massTrash', 'Api\SliderController@massTrash')->name('slider.massTrash');
Route::patch('slider/{slider}/restore', 'Api\SliderController@restore')->name('slider.restore');
Route::patch('slider/massRestore', 'Api\SliderController@massRestore')->name('slider.massRestore');
Route::delete('slider/massDestroy', 'Api\SliderController@massDestroy')->name('slider.massDestroy');
Route::delete('slider/emptyTrash', 'Api\SliderController@emptyTrash')->name('slider.emptyTrash');
Route::apiResource('slider', 'Api\SliderController');