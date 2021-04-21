<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Seeder;
use Str;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = [];

        for ($i = 1; $i <= 100; $i++) {
            $pName = 'Product_' . $i;
            $categoryId = rand(1, 10);
            $newPrice = (rand(1, 5) == 5) ? (rand(10, 1000) * 100) : null;
            $inStock = (rand(1, 10) == 5) ? 1 : null;

            $products[] = [
                'title' => $pName,
                'slug' => Str::slug($pName),
                'category_id' => $categoryId,
                'price' => rand(10, 1000) * 100,
                'new_price' => $newPrice,
                'in_stock' => $inStock,
                'description' => 'Contrary to popular belief, Lorem Ipsum is not simply random text.
                It has roots in a piece of classical Latin literature from 45 BC, making it over 2000
                years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia,
                looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage,
                and going through the cites of the word in classical literature, discovered the undoubtable
                source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum et Malorum"
                (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory
                of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor
                sit amet..", comes from a line in section 1.10.32.'
            ];
        }
        DB::table('products')->insert($products);
    }
}
