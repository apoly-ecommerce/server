<?php
// User

Route::get('user/setup', 'Api\UserController@setup')->name('user.setup');

Route::get('user/auth', 'Api\UserController@userAuth')->name('user.userAuth');

Route::get('user/friends', 'Api\UserController@friends')->name('user.friends');

Route::get('user/paginate', 'Api\UserController@paginate')->name('user.paginate');

Route::get('user/trashed/paginate', 'Api\UserController@trashedPaginate')->name('user.trashedPaginate');

Route::delete('user/{user}/trash', 'Api\UserController@trash')->name('user.trash');

Route::delete('user/massTrash', 'Api\UserController@massTrash')->name('user.massTrash');

Route::patch('user/{user}/restore', 'Api\UserController@restore')->name('user.restore');

Route::patch('user/massRestore', 'Api\UserController@massRestore')->name('user.massRestore');

Route::delete('user/massDestroy', 'Api\UserController@massDestroy')->name('user.massDestroy');

Route::delete('user/emptyTrash', 'Api\UserController@emptyTrash')->name('user.emptyTrash');

Route::put('user/update/password/{user}', 'Api\UserController@updatePassword')->name('user.updatePassword');

Route::apiResource('user', 'Api\UserController');