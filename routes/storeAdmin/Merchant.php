<?php

Route::get('merchant/paginate', 'Api\MerchantController@paginate')->name('merchant.paginate');

Route::get('merchant/trashed/paginate', 'Api\MerchantController@trashedPaginate')->name('merchant.trashedPaginate');

Route::delete('merchant/{merchant}/trash', 'Api\MerchantController@trash')->name('merchant.trash');

Route::delete('merchant/massTrash', 'Api\MerchantController@massTrash')->name('merchant.massTrash');

Route::patch('merchant/{merchant}/restore', 'Api\MerchantController@restore')->name('merchant.restore');

Route::patch('merchant/massRestore', 'Api\MerchantController@massRestore')->name('merchant.massRestore');

Route::delete('merchant/massDestroy', 'Api\MerchantController@massDestroy')->name('merchant.massDestroy');

Route::delete('merchant/emptyTrash', 'Api\MerchantController@emptyTrash')->name('merchant.emptyTrash');

Route::put('merchant/update/password/{id}', 'Api\MerchantController@updatePassword')->name('merchant.updatePassword');

Route::apiResource('merchant', 'Api\MerchantController');