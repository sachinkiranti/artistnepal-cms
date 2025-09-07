<?php

namespace Database\Factories;

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Foundation\Lib\Category as CategoryType;
use Faker\Generator as Faker;
use Foundation\Models\Category;

$factory->define(Category::class, function (Faker $faker) {
    return [
        'parent_id' => 0,
        'category_name' => $faker->firstName,
        'slug' => $faker->slug,
        'description' => $faker->sentence(),
        'status' => rand(0, 1),
        'created_by'    => \Foundation\Models\User::inRandomOrder()->value('id'),
    ];
});
