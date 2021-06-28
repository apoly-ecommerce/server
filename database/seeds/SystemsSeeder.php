<?php

use Carbon\Carbon;

class SystemsSeeder extends BaseSeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('systems')->insert([
            'install_version' => \App\Models\System::VERSION,

            //Mandatory Settings
            'name' => 'Apoly',
            'legal_name' => 'Apoly Inc.',
            'email' => 'phamdinhhung2k1.it@gmail.com',

            // Support
            'support_phone' => '0385763717',
            'support_email' => 'phamdinhhung2k1.it@gmail.com',
            'default_sender_email_address' => 'phamdinhhung2k1.it@gmail.com',
            'default_email_sender_name' => 'Apoly',

            // Social Links
            'facebook_link' => 'https://www.facebook.com/it.phamdinhhung',
            'google_plus_link' => 'https://plus.google.com/',
            'youtube_link' => 'https://www.youtube.com/',

            // Currency
            'show_currency_symbol' => 1,

            // Reporting
            'google_analytic_report' => 0,

            // Checkout
            'allow_guest_checkout' => 1,

            // Address
            'address_show_map' => 1,
            'address_default_country' => 704,
            'address_default_state' => 109,
            'address_show_country' => 1,

            'created_at' => Carbon::Now(),
            'updated_at' => Carbon::Now(),
        ]);

        \DB::table('addresses')->insert([
            'address_type' => 'Primary',
            'address_line_1' => 'Platform Address',
            'country_id' => 704,
            'state_id' => 109,
            'zip_code' => 70000,
            'city' => 'TP Hồ Chí Minh',
            'addressable_id' => 1,
            'addressable_type' => 'App\Models\System',
            'created_at' => Carbon::Now(),
            'updated_at' => Carbon::Now()
        ]);
    }
}
