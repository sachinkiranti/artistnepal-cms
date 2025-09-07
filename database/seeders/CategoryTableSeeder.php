<?php

namespace Database\Seeders;

use Foundation\Lib\Category as CategoryType;
use Foundation\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Kiranti\Config\Status;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        Category::create([
//            'unique_identifier' => \Foundation\Lib\Utility::randomNumber(),
//            'parent_id' => 0,
//            'category_name' => 'English',
//            'slug' => 'english',
//            'status' => Status::ACTIVE_STATUS,
//            'created_by'    => 1,
//        ]);
//        factory(Category::class, 5)->create();

        \Illuminate\Database\Eloquent\Model::unguard();

        Schema::disableForeignKeyConstraints();

        if (Schema::hasTable((new Category())->getTable())) :

            Category::truncate();

//            (new \Importer\CategoryImporter( new \Foundation\Services\CategoryService(new Category()) ))->import();

            $enCategories = [
                'Kathmandu',
                'Nepal',
                'World',
                'Opinion',
                'Business',
                'Sports',
                'Lifestyle',
                'Entertainment',
                'Education',
                'Technology',
                'Horoscope',
            ];

            foreach ($enCategories as $category) :

                $identifier = \Foundation\Lib\Utility::randomNumber();
                Category::create([
                    'parent_id' => 0,
                    'category_name' => $category,
                    'slug' => \Illuminate\Support\Str::slug($category.$identifier),
                    'status' => Status::ACTIVE_STATUS,
                    'lang'  => \Kiranti\Config\Language::ENGLISH,
                    'created_by'    => 1,
                ]);

            endforeach;

        endif;

        Schema::enableForeignKeyConstraints();
    }
}
