<?php

Route::get('role/getRolePermissionsByUser', 'Api\RoleController@getRolePermissionsByUser')->name('role.getRolePermissionsByUser');

Route::get('role/paginate', 'Api\RoleController@paginate')->name('role.paginate');

Route::get('role/trashed/paginate', 'Api\RoleController@trashedPaginate')->name('role.trashedPaginate');

Route::delete('role/{role}/trash', 'Api\RoleController@trash')->name('role.trash');

Route::delete('role/massTrash', 'Api\RoleController@massTrash')->name('role.massTrash');

Route::patch('role/{role}/restore', 'Api\RoleController@restore')->name('role.restore');

Route::patch('role/massRestore', 'Api\RoleController@massRestore')->name('role.massRestore');

Route::delete('role/massDestroy', 'Api\RoleController@massDestroy')->name('role.massDestroy');

Route::delete('role/emptyTrash', 'Api\RoleController@emptyTrash')->name('role.emptyTrash');

Route::put('role/update/password/{role}', 'Api\RoleController@updatePassword')->name('role.updatePassword');

Route::apiResource('role', 'Api\RoleController');