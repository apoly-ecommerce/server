<?php

Route::patch('config/maintenanceMode/{shop}/toggle', 'Api\ConfigController@toggleMaintenanceMode')->name('config.toggleMaintenanceMode');

Route::patch('config/notification/{node}/toggle', 'Api\ConfigController@toggleNotification')->name('config.toggleNotification');

Route::put('config/updateConfig/{config}', 'Api\ConfigController@updateConfig')->name('config.update');

Route::get('config/general', 'Api\ConfigController@viewGeneralSetting')->name('config.general');

Route::put('config/updateBasicConfig/{shop}', 'Api\ConfigController@updateBasicConfig')->name('config.update');

Route::get('config', 'Api\ConfigController@view')->name('config.view');