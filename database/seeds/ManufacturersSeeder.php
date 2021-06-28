<?php

use Carbon\Carbon;

class ManufacturersSeeder extends BaseSeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $shops = \DB::table('shops')->pluck('id')->toArray();
        $countries = \DB::table('countries')->pluck('id')->toArray();

        \DB::table('manufacturers')->insert([
            [
                'shop_id' => $shops ? $shops[array_rand($shops)] : null,
                'name' => 'Điện máy xanh',
                'slug' => 'dien-may-xanh',
                'email' => 'dienmayxanh@gmail.com',
                'url' => 'https://dienmayxanh.com',
                'phone' => '0123456780',
                'description' => 'Nhà cung cấp điện máy xanh',
                'country_id' => $countries[array_rand($countries)],
                'created_at' => Carbon::Now(),
                'updated_at' => Carbon::Now()
            ],[
                'shop_id' => $shops ? $shops[array_rand($shops)] : null,
                'name' => 'sellphones',
                'slug' => 'sellphones',
                'email' => 'sellphones@gmail.com',
                'url' => 'https://sellphones.com',
                'phone' => '0123456781',
                'description' => 'Nhà cung cấp cellphones',
                'country_id' => $countries[array_rand($countries)],
                'created_at' => Carbon::Now(),
                'updated_at' => Carbon::Now()
            ],[
                'shop_id' => $shops ? $shops[array_rand($shops)] : null,
                'name' => 'Thế giới di động',
                'slug' => 'the-gioi-di-dong',
                'email' => 'thegioididong@gmail.com',
                'url' => 'https://thegioididong.com',
                'phone' => '0123456782',
                'description' => 'Nhà cung cấp thế giới di động',
                'country_id' => $countries[array_rand($countries)],
                'created_at' => Carbon::Now(),
                'updated_at' => Carbon::Now()
            ],[
                'shop_id' => $shops ? $shops[array_rand($shops)] : null,
                'name' => 'FPT Shop',
                'slug' => 'fpt-shop',
                'email' => 'fptshop@gmail.com',
                'url' => 'https://fptshop.com',
                'phone' => '0123456782',
                'description' => 'Nhà cung cấp fpt shop',
                'country_id' => $countries[array_rand($countries)],
                'created_at' => Carbon::Now(),
                'updated_at' => Carbon::Now()
            ],
        ]);
    }
}
