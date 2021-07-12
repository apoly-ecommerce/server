<?php

Route::get('address/setup', 'AddressController@setup')->name('address.setup');
Route::get('address/addresses/{addressable_type}/{addressable_id}', 'AddressController@addresses')->name('address.addresses');
Route::apiResource('address', 'AddressController');