<?php

use Carbon\Carbon;

class CategoryGroupsSeeder extends BaseSeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('category_groups')->insert([
            [
                'id' => 1,
                'name' => 'Nhà và Vườn',
                'slug' => 'nha-va-vuon',
                'description' => 'Đồ nấu nướng, Phòng ăn, Bồn tắm, Trang trí nội thất và hơn thế nữa',
                'icon' => 'fa-shower',
                'created_at' => Carbon::Now(),
                'updated_at' => Carbon::Now(),
            ],[
                'id' => 2,
                'name' => 'Thiết bị điện tử',
                'slug' => 'thiet-bi-dien-tu',
                'description' => 'Di động, Máy tính, Máy tính bảng, Máy ảnh, v.v.',
                'icon' => 'fa-plug',
                'created_at' => Carbon::Now(),
                'updated_at' => Carbon::Now(),
            ],[
                'id' => 3,
                'name' => 'Trẻ em và đồ chơi',
                'slug' => 'tre-em-va-do-choi',
                'description' => 'Đồ chơi, giày dép, v.v.',
                'icon' => 'fa-gamepad',
                'created_at' => Carbon::Now(),
                'updated_at' => Carbon::Now(),
            ],[
                'id' => 4,
                'name' => 'Quần áo và Giày',
                'slug' => 'quan-ao-va-giay',
                'description' => 'Giày dép, quần áo, các mặt hàng phong cách sống',
                'icon' => 'fa-tshirt',
                'created_at' => Carbon::Now(),
                'updated_at' => Carbon::Now(),
            ],[
                'id' => 5,
                'name' => 'Sắc đẹp và Sức khỏe',
                'slug' => 'sac-dep-va-suc-khoe',
                'description' => 'Mỹ phẩm, Thực phẩm và hơn thế nữa.',
                'icon' => 'fa-hot-tub',
                'created_at' => Carbon::Now(),
                'updated_at' => Carbon::Now(),
            ],[
                'id' => 6,
                'name' => 'Thể thao',
                'slug' => 'the-thao',
                'description' => 'Đua xe đạp, Quần vợt, Quyền anh, Cricket và hơn thế nữa.',
                'icon' => 'fa-skiing',
                'created_at' => Carbon::Now(),
                'updated_at' => Carbon::Now(),
            ],[
                'id' => 7,
                'name' => 'Đồ trang sức',
                'slug' => 'do-trang-suc',
                'description' => 'Nhẫn đeo cổ, Nhẫn, Mặt dây chuyền và hơn thế nữa.',
                'icon' => 'fa-gem',
                'created_at' => Carbon::Now(),
                'updated_at' => Carbon::Now(),
            ],[
                'id' => 8,
                'name' => 'Vật nuôi',
                'slug' => 'vat-nuoi',
                'description' => 'Thức ăn và đồ dùng cho thú cưng.',
                'icon' => 'fa-dog',
                'created_at' => Carbon::Now(),
                'updated_at' => Carbon::Now(),
            ],[
                'id' => 9,
                'name' => 'Sở thích & Tự làm',
                'slug' => 'so-thich-tu-lam',
                'description' => 'May thủ công, Nguồn cung cấp và hơn thế nữa.',
                'icon' => 'fa-paint-brush',
                'created_at' => Carbon::Now(),
                'updated_at' => Carbon::Now(),
            ]
        ]);
    }
}
