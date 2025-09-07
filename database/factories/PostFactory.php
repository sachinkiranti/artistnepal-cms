<?php

namespace Database\Factories;

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Foundation\Models\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'unique_identifier' => mt_rand(1000000000, 9999999999),
        'category_id'   => \Foundation\Models\Category::inRandomOrder()->where('lang', \Kiranti\Config\Language::ENGLISH)->value('id'),
        'title'         => $faker->text,
        'slug'          => $faker->slug,
        'content'       => $faker->sentence(),
        'views'         => rand(0, 11),
        'status'        => rand(0, 1),
        'created_by'    => \Foundation\Models\User::inRandomOrder()->value('id'),
        'lang'          => \Kiranti\Config\Language::ENGLISH,
    ];
});
