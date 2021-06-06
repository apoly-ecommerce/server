<?php

Route::post('categoryGroup/add', 'Api\CategoryGroupController@store')->name('categoryGroup.store');
Route::get('categoryGroup/list', 'Api\CategoryGroupController@index')->name('categoryGroup.index');
Route::get('categoryGroup/list/paginate', 'Api\CategoryGroupController@allPaginate')->name('categoryGroup.allPaginate');
Route::get('categoryGroup/list/hierarchy', 'Api\CategoryGroupController@hierarchy')->name('categoryGroup.hierarchy');
Route::get('categoryGroup/list/trashed/paginate', 'Api\CategoryGroupController@allTrashedPaginate')->name('categoryGroup.allTrashedPaginate');
Route::delete('categoryGroup/trash/{id}', 'Api\CategoryGroupController@trash')->name('categoryGroup.trash');
Route::delete('categoryGroup/massTrash', 'Api\CategoryGroupController@massTrash')->name('categoryGroup.massTrash');
Route::delete('categoryGroup/destroy/{id}', 'Api\CategoryGroupController@destroy')->name('categoryGroup.destroy');
Route::delete('categoryGroup/massDestroy', 'Api\CategoryGroupController@massDestroy')->name('categoryGroup.massDestroy');
Route::patch('categoryGroup/restore/{id}', 'Api\CategoryGroupController@restore')->name('categoryGroup.restore');
Route::patch('categoryGroup/massRestore', 'Api\CategoryGroupController@massRestore')->name('categoryGroup.massRestore');
Route::get('categoryGroup/show/{id}', 'Api\CategoryGroupController@show')->name('categoryGroup.show');
Route::put('categoryGroup/update/{id}', 'Api\CategoryGroupController@update')->name('categoryGroup.update');