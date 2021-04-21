<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Seeder;

class ProductsImagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 4; $i++) {
            $img = 'details_' . $i . '.jpg';

            $images[] = [
                'product_id' => 1,
                'image' => $img,
            ];
        }

        for ($i = 1; $i <= 12; $i++){
            $img = 'product_' . $i . '.jpg';

            $images[] = [
                'product_id' => $i,
                'image' => $img,
            ];
        }

        DB::table('product_images')->insert($images);
    }
}
