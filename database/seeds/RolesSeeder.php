<?php

use Carbon\Carbon;

class RolesSeeder extends BaseSeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('roles')->insert([
            [
                'id'          => 1,
                'shop_id'     => null,
                'name'        => 'Super Admin',
                'description' => 'Super Admin can do anything over the application.',
                'public'      => 0,
                'level'       => 1,
                'created_at'  => Carbon::Now(),
                'updated_at'  => Carbon::Now(),
            ],
            [
                'id'          => 2,
                'shop_id'     => null,
                'name'        => 'Admin',
                'description' => 'Admins can do anything over the application, Just can not access Super Admin and other Admins information.',
                'public'      => 0,
                'level'       => 2,
                'created_at'  => Carbon::Now(),
                'updated_at'  => Carbon::Now(),
            ],
            [
                'id'          => 3,
                'shop_id'     => null,
                'name'        => 'Merchant',
                'description' => 'The owner of a shop. A merchant can control all contents user his/her shop.',
                'public'      => 0,
                'level'       => 3,
                'created_at'  => Carbon::Now(),
                'updated_at'  => Carbon::Now(),
            ],
            [
                'id'          => 4,
                'shop_id'     => null,
                'name'        => 'Order Handler',
                'description' => 'Only can access order information under his/her shop.',
                'public'      => 1,
                'level'       => 4,
                'created_at'  => Carbon::Now(),
                'updated_at'  => Carbon::Now(),
            ]
        ]);
    }
}