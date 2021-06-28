<?php

use Carbon\Carbon;

class CategoriesSeeder extends BaseSeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category_sub_groups = \DB::table('category_sub_groups')->pluck('id')->toArray();

        \DB::table('categories')->insert([
            [
                'category_sub_group_id' => $category_sub_groups[array_rand($category_sub_groups)],
                'name' => 'Điện thoại',
                'slug' => 'dien-thoai',
                'description' => 'Điện thoại thông minh',
                'featured' => 1,
                'created_at' => Carbon::Now(),
                'updated_at' => Carbon::Now()
            ],[
                'category_sub_group_id' => $category_sub_groups[array_rand($category_sub_groups)],
                'name' => 'Phụ kiện điện thoại',
                'slug' => 'phu-kien-dien-thoai',
                'description' => 'Tai nghe, Bộ điều hợp, Vỏ, v.v.',
                'featured' => 1,
                'created_at' => Carbon::Now(),
                'updated_at' => Carbon::Now()
            ],[
                'category_sub_group_id' => $category_sub_groups[array_rand($category_sub_groups)],
                'name' => 'Laptop',
                'slug' => 'Laptop',
                'description' => 'Laptop',
                'featured' => 1,
                'created_at' => Carbon::Now(),
                'updated_at' => Carbon::Now()
            ],[
                'category_sub_group_id' => $category_sub_groups[array_rand($category_sub_groups)],
                'name' => 'Máy tính bàn',
                'slug' => 'may-tinh-ban',
                'description' => 'Máy tính bàn',
                'featured' => 1,
                'created_at' => Carbon::Now(),
                'updated_at' => Carbon::Now()
            ],[
                'category_sub_group_id' => $category_sub_groups[array_rand($category_sub_groups)],
                'name' => 'Máy tính bảng',
                'slug' => 'may-tinh-bang',
                'description' => 'Máy tính bảng và phụ kiện',
                'featured' => 1,
                'created_at' => Carbon::Now(),
                'updated_at' => Carbon::Now()
            ],[
                'category_sub_group_id' => $category_sub_groups[array_rand($category_sub_groups)],
                'name' => 'Tivi',
                'slug' => 'tivi',
                'description' => 'Tivi và phụ kiện',
                'featured' => 1,
                'created_at' => Carbon::Now(),
                'updated_at' => Carbon::Now()
            ],[
                'category_sub_group_id' => $category_sub_groups[array_rand($category_sub_groups)],
                'name' => 'Hệ thống rạp hát tại nhà',
                'slug' => 'he-thong-rap-hat-tai-nha',
                'description' => 'Hệ thống rạp hát tại nhà và phụ kiện',
                'featured' => 1,
                'created_at' => Carbon::Now(),
                'updated_at' => Carbon::Now()
            ],[
                'category_sub_group_id' => $category_sub_groups[array_rand($category_sub_groups)],
                'name' => 'Máy ảnh Point & Shoot',
                'slug' => 'may-anh-point-va-shoot',
                'description' => 'Máy ảnh và shoot',
                'featured' => 1,
                'created_at' => Carbon::Now(),
                'updated_at' => Carbon::Now()
            ]
        ]);
    }
}
