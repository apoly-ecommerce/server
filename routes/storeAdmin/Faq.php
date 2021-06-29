<?php

// FaqTopic
Route::apiResource('faqTopic', 'Api\FaqTopicController');

// Faq
Route::get('faq/paginate', 'Api\FaqController@paginate')->name('faq.paginate');
Route::apiResource('faq', 'Api\FaqController');