<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //ini dibuat karena category yang kita buat sudah fix tidak ada feature CRUD
        DB::table('categories')->insert([
            [
                'name' => 'Startup',
                'slug' => 'startup',
            ],
            [
                'name' => 'Life',
                'slug' => 'life',
            ],
            [
                'name' => 'Life Lessons',
                'slug' => 'life-lessons',
            ],
            [
                'name' => 'Politics',
                'slug' => 'politics',
            ],
            [
                'name' => 'Travel',
                'slug' => 'travel',
            ],
            [
                'name' => 'Poetry',
                'slug' => 'poetry',
            ],
            [
                'slug' => 'Enterpreunership',
                'name' => 'enterpreunership',
            ],
            [
                'slug' => 'Education',
                'name' => 'education',
            ],
            [
                'slug' => 'Health',
                'name' => 'health',
            ],
            [
                'slug' => 'Love',
                'name' => 'love',
            ],
            [
                'slug' => 'Design',
                'name' => 'design',
            ],
            [
                'slug' => 'Writing',
                'name' => 'writing',
            ],
            [
                'slug' => 'Technology',
                'name' => 'technology',
            ],
        ]);
    }
}
