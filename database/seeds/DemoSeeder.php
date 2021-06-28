<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class DemoSeeder extends BaseSeeder
{

    private $now;

    public function __construct()
    {
        $this->now = Carbon::now();
    }
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = \DB::table('categories')->pluck('id')->toArray();
        $manufacturers = \DB::table('manufacturers')->pluck('id')->toArray();

        \DB::table('options')->insert([
            [
                'option_name' => 'trending_categories',
                'option_value' => serialize($this->array_random($categories, 3)),
                'autoload' => 1,
                'created_at' => $this->now,
                'updated_at' => $this->now
            ],
            [
                'option_name' => 'featured_brands',
                'option_value' => serialize($this->array_random($manufacturers, 3)),
                'autoload' => 1,
                'created_at' => $this->now,
                'updated_at' => $this->now
            ]
        ]);
    }
}
