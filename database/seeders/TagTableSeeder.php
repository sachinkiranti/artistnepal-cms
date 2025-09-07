<?php

namespace Database\Seeders;

use Foundation\Models\Tag;
use Illuminate\Database\Seeder;

class TagTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tag::create([
            'tag_name' => 'Product',
            'slug' => 'product',
            'description' => 'this is some thing about product',
            'status' => \Kiranti\Config\Status::ACTIVE_STATUS,
        ]);
        Tag::factory()->count(5)->create();
    }
}
