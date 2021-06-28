<?php

Route::get('address/addresses/{addressable_type}/{addressable_id}', 'AddressController@addresses')->name('address.addresses');
Route::apiResource('address', 'AddressController');