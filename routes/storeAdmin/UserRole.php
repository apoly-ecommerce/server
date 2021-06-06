<?php

Route::get('role/getRolePermissionsByUser', 'Api\RoleController@getRolePermissionsByUser')->name('role.getRolePermissionsByUser');
Route::post('role/add', 'Api\RoleController@store')->name('role.store');
Route::put('role/update/{id}', 'Api\RoleController@update')->name('role.update');
Route::get('role/list', 'Api\RoleController@index')->name('role.index');
Route::get('role/list/trashed', 'Api\RoleController@allTrashed')->name('role.allTrashed');
Route::delete('role/trash/{id}', 'Api\RoleController@trash')->name('role.trash');
Route::delete('role/massTrash', 'Api\RoleController@massTrash')->name('role.massTrash');
Route::patch('role/restore/{id}', 'Api\RoleController@restore')->name('role.restore');
Route::patch('role/massRestore', 'Api\RoleController@massRestore')->name('role.massRestore');
Route::delete('role/destroy/{id}', 'Api\RoleController@destroy')->name('role.destroy');
Route::delete('role/massDestroy', 'Api\RoleController@massDestroy')->name('role.massDestroy');
Route::get('role/show/{id}', 'Api\RoleController@show')->name('role.show');