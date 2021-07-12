<?php

Route::get('notifications', 'Api\NotificationController@notifications')->name('notification');

Route::get('notification/unread', 'Api\NotificationController@unreadNotifications')->name('notification.unread');

Route::patch('notification/markAsRead', 'Api\NotificationController@markAllNotificationsAsRead')->name('notification.markAsRead');

Route::delete('notification/{notification}/destroy', 'Api\NotificationController@destroy')->name('notification.destroy');

Route::delete('notification/destroyAll', 'Api\NotificationController@destroyAll')->name('notification.destroyAll');