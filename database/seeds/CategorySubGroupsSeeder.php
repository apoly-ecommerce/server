<?php

use Carbon\Carbon;

class CategorySubGroupsSeeder extends BaseSeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('category_sub_groups')->insert([
            [
                'category_group_id' => 1,
                'name' => 'Di động và phụ kiện',
                'slug' => 'phu-kien-va-di-dong',
                'description' => 'Điện thoại di động và Phụ kiện',
                'created_at' => Carbon::Now(),
                'updated_at' => Carbon::Now(),
            ],[
                'category_group_id' => 1,
                'name' => 'Máy tính và phụ kiện',
                'slug' => 'may-tinh-va-phu-kien',
                'description' => 'Máy tính bảng, máy tính xách tay, máy tính để bàn và phụ kiện',
                'created_at' => Carbon::Now(),
                'updated_at' => Carbon::Now(),
            ],[
                'category_group_id' => 1,
                'name' => 'Giải trị tại nhà',
                'slug' => 'giai-tri-tai-nha',
                'description' => 'TV, Rạp hát tại nhà, v.v.',
                'created_at' => Carbon::Now(),
                'updated_at' => Carbon::Now(),
            ],[
                'category_group_id' => 1,
                'name' => 'Ảnh & Video',
                'slug' => 'anh-va-video',
                'description' => 'PnS, DSLR, Máy quay video và Phụ kiện',
                'created_at' => Carbon::Now(),
                'updated_at' => Carbon::Now(),
            ],[
                'category_group_id' => 2,
                'name' => 'Trong nhà',
                'slug' => 'trong-nha',
                'description' => 'Câu đố, Keram, v.v.',
                'created_at' => Carbon::Now(),
                'updated_at' => Carbon::Now(),
            ],[
                'category_group_id' => 2,
                'name' => 'Ngoài trời',
                'slug' => 'ngoai-troi',
                'description' => 'Cycle, Dron etc',
                'created_at' => Carbon::Now(),
                'updated_at' => Carbon::Now(),
            ],[
                'category_group_id' => 3,
                'name' => 'Thời trang nam',
                'slug' => 'thoi-trang-nam',
                'description' => 'Rất nhiều sản phẩm thời trang.',
                'created_at' => Carbon::Now(),
                'updated_at' => Carbon::Now(),
            ],[
                'category_group_id' => 3,
                'name' => 'Thời trang nữ',
                'slug' => 'thoi-trang-nu',
                'description' => 'Rất nhiều sản phẩm thời trang.',
                'created_at' => Carbon::Now(),
                'updated_at' => Carbon::Now(),
            ],[
                'category_group_id' => 4,
                'name' => 'Nhà bếp',
                'slug' => 'nha-bep',
                'description' => 'Nhà bếp và các sản phẩm nấu ăn.',
                'created_at' => Carbon::Now(),
                'updated_at' => Carbon::Now(),
            ],[
                'category_group_id' => 4,
                'name' => 'Vườn',
                'slug' => 'garden',
                'description' => 'Sản phẩm liên quan đến làm vườn.',
                'created_at' => Carbon::Now(),
                'updated_at' => Carbon::Now(),
            ]
        ]);
    }
}
