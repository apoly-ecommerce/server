<?php

Route::post('login', 'Admin\Api\AuthController@login')->name('login');
Route::post('logout', 'Admin\Api\AuthController@logout')->name('logout')->middleware('auth:api');