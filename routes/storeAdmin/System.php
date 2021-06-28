<?php

Route::get('system/general', 'Api\SystemController@view')->name('system.view');

Route::put('system/updateBasicSystem', 'Api\SystemController@update')->name('system.update');

Route::patch('system/maintenanceMode/toggle', 'Api\SystemController@toggleMaintenanceMode')->name('system.toggleMaintenanceMode');