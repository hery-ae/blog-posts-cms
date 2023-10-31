<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Category::insert([
            [
                'name' => 'business',
                'verbose_name' => 'Business',
            ],
            [
                'name' => 'technology',
                'verbose_name' => 'Technology',
            ],
            [
                'name' => 'science',
                'verbose_name' => 'Science',
            ],
            [
                'name' => 'health',
                'verbose_name' => 'Health',
            ],
            [
                'name' => 'travel',
                'verbose_name' => 'Travel',
            ],
            [
                'name' => 'opinion',
                'verbose_name' => 'Opinion',
            ],
        ]);
    }
}
