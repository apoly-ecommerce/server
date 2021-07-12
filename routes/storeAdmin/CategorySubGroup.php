<?php

Route::get('categorySubGroup/setup', 'Api\CategorySubGroupController@setup')->name('categorySubGroup.setup');

Route::get('categorySubGroup/paginate', 'Api\CategorySubGroupController@paginate')->name('categorySubGroup.paginate');

Route::get('categorySubGroup/trashed/paginate', 'Api\CategorySubGroupController@trashedPaginate')->name('categorySubGroup.trashedPaginate');

Route::delete('categorySubGroup/{categorySubGroup}/trash', 'Api\CategorySubGroupController@trash')->name('categorySubGroup.trash');

Route::delete('categorySubGroup/massTrash', 'Api\CategorySubGroupController@massTrash')->name('categorySubGroup.massTrash');

Route::patch('categorySubGroup/{categorySubGroup}/restore', 'Api\CategorySubGroupController@restore')->name('categorySubGroup.restore');

Route::patch('categorySubGroup/massRestore', 'Api\CategorySubGroupController@massRestore')->name('categorySubGroup.massRestore');

Route::delete('categorySubGroup/massDestroy', 'Api\CategorySubGroupController@massDestroy')->name('categorySubGroup.massDestroy');

Route::delete('categorySubGroup/emptyTrash', 'Api\CategorySubGroupController@emptyTrash')->name('categorySubGroup.emptyTrash');

Route::delete('categorySubGroup/emptyTrash', 'Api\CategorySubGroupController@emptyTrash')->name('categorySubGroup.emptyTrash');

Route::apiResource('categorySubGroup', 'Api\CategorySubGroupController');