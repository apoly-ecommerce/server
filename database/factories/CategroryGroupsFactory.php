<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

$factory->define(\App\Models\CategoryGroup::class, function (Faker $faker) {
    return [
      'name' => $faker->company,
      'slug' => $faker->slug,
      'active' => 1,
      'description' => $faker->text(500),
    ];
});
