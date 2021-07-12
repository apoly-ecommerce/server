<?php

Route::get('profile', 'Api\AccountController@profile')->name('profile');

Route::put('profile/updatePhoto', 'Api\AccountController@updatePhoto')->name('updatePhoto');
Route::put('profile/update', 'Api\AccountController@update')->name('update');
Route::patch('profile/updatePassword', 'Api\AccountController@updatePassword')->name('updatePassword');
Route::delete('profile/deletePhoto', 'Api\AccountController@deletePhoto')->name('deletePhoto');