<?php

Route::get('state/list/country/{id}', 'Api\StateController@byCountry')->name('byCountry');