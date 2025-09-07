<?php

namespace Database\Factories;

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Foundation\Models\Role;
use Faker\Generator as Faker;
use Kiranti\Config\Status;

$factory->define(Role::class, function (Faker $faker) {
    return [
        'name' => $faker->jobTitle,
        'slug' => $faker->word,
        'description' => $faker->sentence($nbWords = 6, $variableNbWords = true),
        'status' => Status::ACTIVE_STATUS,
    ];
});
