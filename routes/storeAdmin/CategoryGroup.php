<?php

Route::get('categoryGroup/paginate', 'Api\CategoryGroupController@paginate')->name('categoryGroup.paginate');

Route::get('categoryGroup/trashed/paginate', 'Api\CategoryGroupController@trashedPaginate')->name('categoryGroup.trashedPaginate');

Route::get('categoryGroup/export/pdf', 'Api\CategoryGroupController@exportPdf')->name('categoryGroup.exportPdf');

Route::delete('categoryGroup/{categoryGroup}/trash', 'Api\CategoryGroupController@trash')->name('categoryGroup.trash');

Route::delete('categoryGroup/massTrash', 'Api\CategoryGroupController@massTrash')->name('categoryGroup.massTrash');

Route::patch('categoryGroup/{categoryGroup}/restore', 'Api\CategoryGroupController@restore')->name('categoryGroup.restore');

Route::patch('categoryGroup/massRestore', 'Api\CategoryGroupController@massRestore')->name('categoryGroup.massRestore');

Route::delete('categoryGroup/massDestroy', 'Api\CategoryGroupController@massDestroy')->name('categoryGroup.massDestroy');

Route::delete('categoryGroup/emptyTrash', 'Api\CategoryGroupController@emptyTrash')->name('categoryGroup.emptyTrash');

Route::apiResource('categoryGroup', 'Api\CategoryGroupController');
