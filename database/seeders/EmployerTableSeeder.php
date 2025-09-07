<?php

namespace Database\Seeders;

use Foundation\Models\Employer;
use Illuminate\Database\Seeder;

class EmployerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Employer::class, 1)->create();
    }
}
