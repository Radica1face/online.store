<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Seeder;
use Str;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            [
                'title' => 'Смартфоны',
                'slug' => Str::slug('Смартфоны'),
                'image' => 'smart.jpg',
                'description' => 'Смартфоны Xiaomi'
            ],
            [
                'title' => 'Power-банки',
                'slug' => Str::slug('Power-банки'),
                'image' => 'smart.jpg',
                'description' => 'Power-банки'
            ],
            [
                'title' => 'Наушники',
                'slug' => Str::slug('Наушники'),
                'image' => 'audio.jpg',
                'description' => 'Беспроводные наушники'
            ],
            [
                'title' => 'Умный дом',
                'slug' => Str::slug('Умный дом'),
                'image' => 'smart.jpg',
                'description' => 'Оборудование для умного дома'
            ],
            [
                'title' => 'Умные часы и браслеты',
                'slug' => Str::slug('Умные часы и браслеты'),
                'image' => 'cameras.jpg',
                'description' => 'Оборудование для умного дома'
            ],
            [
                'title' => 'Аксесcуары',
                'slug' => Str::slug('Аксеcсуары'),
                'image' => 'cameras.jpg',
                'description' => 'Аксеcсуары для смартфонов'
            ],
        ];

        DB::table('categories')->insert($categories);
    }
}
