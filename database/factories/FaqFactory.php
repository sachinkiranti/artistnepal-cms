<?php

namespace Database\Factories;

use Foundation\Models\Faq;
use Illuminate\Database\Eloquent\Factories\Factory;

class FaqFactory extends Factory
{
    protected $model = Faq::class;

    public function definition()
    {
        return [
            'faq_name' => $this->faker->firstName(),
            'slug' => $this->faker->slug(),
            'body' => $this->faker->sentence(),
            'status' => rand(0, 1),
        ];
    }
}
