<?php

namespace Database\Factories;

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Foundation\Models\Permission;
use Faker\Generator as Faker;
use Kiranti\Config\Status;

$factory->define(Permission::class, function (Faker $faker) {
    return [
        'name' => $faker->words($nb = 2, $asText = true),
        'slug' => $faker->word,
        'description' => $faker->sentence($nbWords = 6, $variableNbWords = true),
        'status' => Status::ACTIVE_STATUS,
    ];
});
