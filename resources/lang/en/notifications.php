<?php

return [
    /*
     |-------------------------------------------------------------------------------
     | Notifications Email Language Lines
     |-------------------------------------------------------------------------------
     | The following language lines are used by the notification library to build
     | the Notification emails. You are free to change them to any thing
     | you want to customize your views to better match your platform.
     | Supported colors are blue, green, and red
     */

     // User Notifications
     'user_created' => [
        'subject' => ':admin added you to the :marketplace marketplace!',
        'greeting' => 'Congratulation :user!',
        'message' => 'You have been added to the :marketplace by :admin! Click the button below to login into your account. Use the temporary password for initial login.',
        'alert' => 'Don\'t forgot to change your password after login.',
        'button_text' => 'Visit your profile',
    ],
    'user_updated' => [
        'subject' => 'Account information updated successfully !',
        'greeting' => 'Congratulation',
        'message' => 'Your marketplace :marketplace just got a new vendor with shop name <strong>:shop_name</strong> and the merchant\'s email address is :merchant_email',
        'button_text' => 'Go to the Dashboard'
    ],

    // Auth notifications
    'password_update' => [
        'subject' => 'Your :marketplace password has been updated successfully!',
        'greeting' => 'Hello :user',
        'message' => 'Your account login password has been changed successfully! If you did not make this change, please contact us asap! Click the button below to login into your profile page.',
        'button_text' => 'Visit Your Profile'
    ],

    // Shop notifications
    'shop_created' => [
        'subject' => 'Your shop is ready to go!',
        'greeting' => 'Congratulation :merchant!',
        'message' => 'Your shop :shop_name has been created successfully! Click the button below to login into shop admin panel.',
        'button_text' => 'Go to the Dashboard',
    ],
    'shop_deleted' => [
        'subject' => 'Your shop has been removed from :marketplace!',
        'greeting' => 'Hello Merchant!',
        'message' => 'This is a notification to let you know that your shop has been deleted from our marketplace! We\'ll miss you.',
    ],

    // System Notifications
    'system_is_down' => [
        'subject' => 'Your marketplace :marketplace is down now!',
        'greeting' => 'Hello :user!',
        'message' => 'This is a notification to let you know that your marketplace :marketplace is down! No customer can visit your marketplace until it\'s back to live again.',
        'button_text' => 'Go to the config page',
    ],

    'system_is_up' => [
        'subject' => 'Your marketplace :marketplace is back to UP!',
        'greeting' => 'Hello :user!',
        'message' => 'This is a notification to let you know that your marketplace :marketplace is back to up successfully!',
        'button_text' => 'Go to the Dashboard',
    ],

    'system_info_updated' => [
        'subject' => ':marketplace - marketplace information updated successfully!',
        'greeting' => 'Hello :user!',
        'message' => 'This is a notification to let you know that your marketplace :marketplace has been updated successfully!',
        'button_text' => 'Go to the Dashboard',
    ],


    // Shop Notifications
    'shop_down_for_maintenance' => [
        'subject' => 'Your shop is down!',
        'greeting' => 'Hello :merchant!',
        'message' => 'This is a notification to let you know that your shop :shop_name is down! No customer can visit your shop until it\'s back to live again.',
        'button_text' => 'Go to the Config page',
    ],

    'shop_up_for_maintenance' => [
        'subject' => 'Your shop is back to LIVE!',
        'greeting' => 'Hello :merchant',
        'message' => 'This is a notification to let you know that your shop :shop_name is back to live successfully!',
        'button_text' => 'Go to the Dashboard',
    ],

    'shop_config_updated' => [
        'subject' => 'Shop configuration updated successfully!',
        'greeting' => 'Hello :merchant!',
        'message' => 'Your shop configuration has been updated successfully! Click the button below to login into shop admin panel.',
        'button_text' => 'Go to the Dashboard',
    ],
];