<?php

Route::group(['middleware' => 'auth:api'], function() {
    include('common/Address.php');
});