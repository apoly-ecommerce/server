<?php

// Theme Options
Route::get('theme/option', 'Api\ThemeOptionController@index')->name('theme.option');

// Featured Brands
Route::get('theme/featuredBrands', 'Api\ThemeOptionController@editFeaturedBrands')->name('theme.editFeaturedBrands');
Route::put('theme/update/featuredBrands', 'Api\ThemeOptionController@updateFeaturedBrands')->name('theme.updateFeaturedBrands');

// Trending Now Categories
Route::get('theme/trendingNowCategories', 'Api\ThemeOptionController@editTrendingNowCategories')->name('theme.editTrendingNowCategories');
Route::put('theme/update/trendingNowCategories', 'Api\ThemeOptionController@updateTrendingNowCategories')->name('theme.updateTrendingNowCategories');