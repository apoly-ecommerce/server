<?php

Route::get('customer/paginate', 'Api\CustomerController@paginate')->name('customer.paginate');

Route::get('customer/trashed/paginate', 'Api\CustomerController@trashedPaginate')->name('customer.trashedPaginate');

Route::delete('customer/{customer}/trash', 'Api\CustomerController@trash')->name('customer.trash');

Route::delete('customer/massTrash', 'Api\CustomerController@massTrash')->name('customer.massTrash');

Route::patch('customer/{customer}/restore', 'Api\CustomerController@restore')->name('customer.restore');

Route::patch('customer/massRestore', 'Api\CustomerController@massRestore')->name('customer.massRestore');

Route::delete('customer/massDestroy', 'Api\CustomerController@massDestroy')->name('customer.massDestroy');

Route::delete('customer/emptyTrash', 'Api\CustomerController@emptyTrash')->name('customer.emptyTrash');

Route::put('customer/update/password/{customer}', 'Api\CustomerController@updatePassword')->name('customer.updatePassword');

Route::apiResource('customer', 'Api\CustomerController');