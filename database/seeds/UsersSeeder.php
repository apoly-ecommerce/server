<?php

use Carbon\Carbon;
use Illuminate\Support\Str;

class UsersSeeder extends BaseSeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('users')->insert([
            [
                'shop_id'            => null,
                'role_id'            => \App\Models\Role::SUPER_ADMIN,
                'name'               => 'Super Admin',
                'nice_name'          => 'Director',
                'email'              => 'admin.super@shop.com',
                'password'           => bcrypt('123456'),
                'verification_token' => Str::random(60),
                'active'             => 1,
                'created_at'         => Carbon::Now(),
                'updated_at'         => Carbon::Now()
            ],
            [
                'shop_id'            => null,
                'role_id'            => \App\Models\Role::ADMIN,
                'name'               => 'Admin',
                'nice_name'          => 'Manager',
                'email'              => 'admin.sub@shop.com',
                'password'           => bcrypt('123456'),
                'verification_token' => Str::random(60),
                'active'             => 1,
                'created_at'         => Carbon::Now(),
                'updated_at'         => Carbon::Now()
            ]
        ]);

        \DB::table('addresses')->insert([
            [
                'address_type'     => 'Primary',
                'address_title'    => 'Primary Address',
                'state_id'         => 704,
                'country_id'       => 704,
                'addressable_id'   => 1,
                'addressable_type' => 'App\User',
                'created_at'       => Carbon::Now(),
                'updated_at'       => Carbon::Now()
            ],
            [
                'address_type'     => 'Primary',
                'address_title'    => 'Primary Address',
                'state_id'         => 704,
                'country_id'       => 704,
                'addressable_id'   => 2,
                'addressable_type' => 'App\User',
                'created_at'       => Carbon::Now(),
                'updated_at'       => Carbon::Now()
            ]
        ]);
    }
}