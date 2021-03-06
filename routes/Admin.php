<?php

Route::post('pusher/auth', function() {
  return true;
});

Route::group(['prefix' => 'admin'], function() {

    Route::group(['as' => 'auth.', 'prefix' => 'auth'], function() {
        include('storeAdmin/Auth.php');
    });

});


Route::group([
    'namespace'  => 'Admin',
    'prefix'     => 'admin',
    'as'         => 'admin.',
    'middleware' => 'auth:api'
], function() {

    // Auth Pusher
    Route::post('pusher/auth', 'Api\PusherController@pusherAuth');

    // Marketplace Admin only routes
    Route::middleware(['admin'])->group(function() {

    });

    // Merchant only routes.
    Route::middleware(['merchant'])->group(function()
    {

    });

    // Account routes for Merchant and Admin.
    Route::group(['as' => 'account.', 'prefix' => 'account'], function()
    {
        include('storeAdmin/Account.php');
    });

    Route::middleware(['subscribed'])->group(function()
    {

        include('storeAdmin/notification.php');

        // Catalog Routes for Admin.
        Route::group(['as' => 'catalog.', 'prefix' => 'catalog'], function()
        {
            include('storeAdmin/CategoryGroup.php');
            include('storeAdmin/CategorySubGroup.php');
            include('storeAdmin/Category.php');
            include('storeAdmin/Manufacturer.php');
            include('storeAdmin/Product.php');
        });

        // Stock Routes for Admin
        Route::group(['as' => 'stock.', 'prefix' => 'stock'], function()
        {
            include('storeAdmin/Inventory.php');
        });

        // Admin Routes for Admin.
        Route::group(['as' => 'admin.', 'prefix' => 'admin'], function()
        {
            include('storeAdmin/User.php');
            include('storeAdmin/Customer.php');
        });

        // Vendor Routes for Admin.
        Route::group(['as' => 'vendor.', 'prefix' => 'vendor'], function()
        {
            include('storeAdmin/Merchant.php');
            include('storeAdmin/Shop.php');
        });

        // Appearances Routes for Admin.
        Route::group(['as' => 'appearance.', 'prefix' => 'appearance'], function()
        {
            include('storeAdmin/Banner.php');
            include('storeAdmin/Slider.php');
            include('storeAdmin/Theme.php');
        });

        // Utility Routes for Admin/Merchant
        Route::group(['as' => 'utility.', 'prefix' => 'utility'], function()
        {
            include('storeAdmin/Faq.php');
        });

        // Setting Routes for Admin/Merchant.
        Route::group(['as' => 'setting.', 'prefix' => 'setting'], function()
        {
            include('storeAdmin/UserRole.php');
            include('storeAdmin/Module.php');
            include('storeAdmin/Country.php');
            include('storeAdmin/State.php');
            include('storeAdmin/System.php');
            include('storeAdmin/Config.php');
            include('storeAdmin/SystemConfig.php');
        });

        // Support Routes for Admin
        Route::group(['as' => 'support.', 'prefix' => 'support'], function()
        {
            include('storeAdmin/UserMessage.php');
            include('storeAdmin/Message.php');
        });

    });

});