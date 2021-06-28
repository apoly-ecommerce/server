<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

$factory->define(\App\Models\Manufacturer::class, function (Faker $faker) {
    return [
        'shop_id' => $faker->randomElement(\DB::table('shops')->pluck('id')->toArray()),
        'name' => $faker->unique(true)->company,
        'slug' => $faker->unique(true)->slug,
        'email' => $faker->unique(true)->email,
        'url' => $faker->unique(true)->url,
        'phone' => $faker->unique(true)->phoneNumber,
        'description' => $faker->text(500),
        'country_id' => $faker->randomElement(\DB::table('countries')->pluck('id')->toArray()),
        'active' => 1
    ];
});
