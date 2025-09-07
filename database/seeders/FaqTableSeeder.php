<?php

namespace Database\Seeders;

use Foundation\Models\Faq;
use Illuminate\Database\Seeder;

class FaqTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Faq::create([
            'faq_name' => 'Something',
            'slug' => 'something',
            'body' => 'this is some thing about product',
            'status' => \Kiranti\Config\Status::ACTIVE_STATUS,
        ]);

        Faq::factory()->count(5)->create();
    }
}
