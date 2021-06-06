<?php

Route::get('countries', 'CountryController@all')->name('countries');
Route::get('statesByCountryId', 'StateController@getByCountryId')->name('statesByCountryId');