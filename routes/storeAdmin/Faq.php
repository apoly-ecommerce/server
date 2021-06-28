<?php

Route::apiResource('faqTopic', 'Api\FaqTopicController');

Route::get('faq/paginate', 'Api\FaqController@paginate')->name('faq.paginate');
Route::apiResource('faq', 'Api\FaqController');