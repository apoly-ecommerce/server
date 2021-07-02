<?php

Route::post('login', 'Admin\Api\AuthController@login')->name('login');

Route::get('user', 'Admin\Api\AuthController@user')->name('user_auth')->middleware('auth:api');

Route::post('logout', 'Admin\Api\AuthController@logout')->name('logout')->middleware('auth:api');