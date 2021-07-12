<?php

Route::patch('system/config/{node}/toggle', 'Api\SystemConfigController@toggleConfig')->name('system.toggleConfig');

Route::put('system/updateConfig', 'Api\SystemConfigController@update')->name('system.update');

Route::get('system/config', 'Api\SystemConfigController@view')->name('system.view');