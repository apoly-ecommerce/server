<?php

use Carbon\Carbon;

class CountriesSeeder extends BaseSeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Get all of the countries.
        $countries = json_decode(file_get_contents(__DIR__.'/data/countries.json'), true);

        foreach ($countries as $countryId => $country)
        {
            // Ignore countries that don't have iso_code.
            if (! isset($country['iso_code'])) continue;

            // Get the currency of the country.
            if (isset($country['currency_code'])) {
                $currency = \DB::table('currencies')->select('id')
                                ->where('iso_code', $country['currency_code'])
                                ->first();
            }

            // Insert data into table countries.
            \DB::table('countries')->insert([
                'id'           => $countryId,
                'name'         => $country['name'],
                'full_name'    => isset($country['full_name']) ? $country['full_name'] : null,
                'capital'      => isset($country['capital']) ? $country['capital'] : null,
                'timezone_id'  => isset($timezone) && $timezone ? $timezone->id : null,
                'currency_id'  => isset($currency) && $currency ? $currency->id : null,
                'citizenship'  => isset($country['citizenship']) ? $country['citizenship'] : null,
                'iso_code'     => $country['iso_code'],
                'iso_numeric'  => isset($country['iso_numeric']) ? $country['iso_numeric'] : null,
                'calling_code' => isset($country['calling_code']) ? $country['calling_code'] : null,
                'flag'         => isset($country['flag']) ? $country['flag'] : null,
                'eea'          => (bool) $country['eea'],
                'active'       => 1,
                'created_at'   => Carbon::Now(),
                'updated_at'   => Carbon::Now(),
            ]);
        }
    }
}