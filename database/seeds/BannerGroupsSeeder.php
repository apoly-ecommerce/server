<?php

class BannerGroupsSeeder extends BaseSeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('banner_groups')->insert([
            [
                'id' => 'group_1',
                'name' => 'group 1'
            ],[
                'id' => 'group_2',
                'name' => 'group 2'
            ],[
                'id' => 'group_3',
                'name' => 'group 3'
            ],[
                'id' => 'group_4',
                'name' => 'group 4'
            ],[
                'id' => 'group_5',
                'name' => 'group 5'
            ],[
                'id' => 'group_6',
                'name' => 'group 6'
            ],
        ]);
    }
}
