<?php

Route::get('user/auth', 'Api\UserController@userAuth')->name('user.userAuth');
Route::post('user/add', 'Api\UserController@store')->name('user.store');
Route::get('user/list/paginate', 'Api\UserController@allPaginate')->name('user.allPaginate');
Route::get('user/list/trashed/paginate', 'Api\UserController@allTrashedPaginate')->name('user.allTrashedPaginate');
Route::get('user/show/{id}', 'Api\UserController@show')->name('user.show');
Route::delete('user/trash/{id}', 'Api\UserController@trash')->name('user.trash');
Route::delete('user/massTrash', 'Api\UserController@massTrash')->name('user.massTrash');
Route::delete('user/destroy/{id}', 'Api\UserController@destroy')->name('user.destroy');
Route::delete('user/massDestroy', 'Api\UserController@massDestroy')->name('user.massDestroy');
Route::delete('user/emptyTrash', 'Api\UserController@emptyTrash')->name('product.emptyTrash');
Route::patch('user/restore/{id}', 'Api\UserController@restore')->name('user.restore');
Route::patch('user/massRestore', 'Api\UserController@massRestore')->name('user.massRestore');
Route::put('user/update/{id}', 'Api\UserController@update')->name('user.update');
Route::put('user/update/password/{id}', 'Api\UserController@updatePassword')->name('user.updatePassword');
