<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

$factory->define(\App\Models\Product::class, function (Faker $faker) {
    return [
        'shop_id' => rand(0, 1) ? 1 : null,
        'manufacturer_id' => $faker->randomElement(\DB::table('manufacturers')->pluck('id')->toArray()),
        'brand' => $faker->word,
        'name' => $faker->sentence,
        'model_number' => $faker->word . ' '.$faker->bothify('??###'),
        'mpn' => $faker->randomNumber(NULL, false),
        'detail_information' => $faker->text($faker->randomElement([200,300,400,500])),
        'description' => $faker->text($faker->randomElement([200,300,400,500])),
        'promotional_price' => $faker->randomFloat(NULL, 1000, NULL),
        'original_price' => $faker->randomFloat(NULL, 1500, NULL),
        'slug' => $faker->slug,
        'active' => 1,
    ];
});
