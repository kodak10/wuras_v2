<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $products = DB::table('products')->pluck('id');
        $images = DB::table('images')->pluck('id');

        foreach ($products as $product) {
            $image = $images->random(); // Random image for each product
            DB::table('product_image')->insert([
                'product_id' => $product,
                'image_id' => $image,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
