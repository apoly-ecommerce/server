<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

$factory->define(\App\Models\Category::class, function (Faker $faker) {
    return [
        'category_sub_group_id' => $faker->randomElement(\DB::table('category_sub_groups')->pluck('id')->toArray()),
        'name' => $faker->unique(true)->company,
        'slug' => $faker->unique(true)->slug,
        'description' => $faker->text(500),
        'featured' => $faker->randomElement([0,1]),
        'active' => 1
    ];
});
