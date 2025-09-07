<?php

namespace Database\Seeders;

use Faker\Factory as Faker;
use Foundation\Models\Post;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class PostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app('db')->connection()->disableQueryLog();

        \Illuminate\Database\Eloquent\Model::unguard();

        Schema::disableForeignKeyConstraints();

        if (Schema::hasTable((new Post())->getTable())) :

            Post::truncate();

//            (new \Importer\PostImporter())->import();

            $faker = Faker::create();
            $lang = \Kiranti\Config\Language::ENGLISH;
            $timestamp = now();
            $posts = [];

            foreach (range(1, 1000) as $index)
            {
                $posts[] = [
                    'unique_identifier' => mt_rand(1000000000, 9999999999),
                    'category_id'   => \Foundation\Models\Category::inRandomOrder()->where('lang', $lang)->value('id'),
                    'title'         => $faker->title,
                    'slug'          => $faker->slug,
                    'content'       => $faker->sentence(),
                    'views'         => rand(0, 11),
                    'status'        => rand(0, 1),
                    'created_by'    => \Foundation\Models\User::inRandomOrder()->value('id'),
                    'lang'          => $lang,
                    'created_at'    => $timestamp,
                    'updated_at'    => $timestamp,
                    'published_date'  => $timestamp,
                ];
            }

            Post::insert($posts);

        endif;

        Schema::enableForeignKeyConstraints();
    }
}
