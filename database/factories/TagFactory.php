<?php

namespace Database\Factories;

use Foundation\Models\Tag;
use Illuminate\Database\Eloquent\Factories\Factory;

class TagFactory extends Factory
{
    protected $model = Tag::class;

    public function definition()
    {
        return [
            'tag_name' => $this->faker->firstName(),
            'slug' => $this->faker->slug(),
            'description' => $this->faker->sentence(),
            'status' => rand(0, 1),
        ];
    }
}
