<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $faker = Faker::create();
        $categories = DB::table('categories')->pluck('id');
        
        for ($i = 1; $i <= 200; $i++) {
            $category_id = $categories->random();
            $has_discount = rand(0, 1); // 50% chance to have a discount
            $price = $faker->randomFloat(2, 50, 2000); // price between 50 and 2000
            $discount = $has_discount ? $faker->randomFloat(2, 5, 500) : 0;

            DB::table('products')->insert([
                'name' => $faker->word() . ' ' . ucfirst($faker->word()),
                'marque' => $faker->company(),
                'weight' => $faker->randomFloat(2, 0.5, 5), // weight between 0.5kg and 5kg
                'genre' => $faker->randomElement(['Men', 'Women', 'Unisex']),
                'description' => $faker->paragraph(),
                'stock' => rand(10, 200), // stock between 10 and 200
                'price' => $price,
                'discount' => $discount,
                'colors' => json_encode([$faker->safeColorName(), $faker->safeColorName()]),
                'tags' => json_encode([$faker->word(), $faker->word()]),
                'created_at' => now(),
                'updated_at' => now(),
                'category_id' => $category_id,
                'slug' => $faker->slug(),
                'image_path' => 'https://via.placeholder.com/600x400?text=Product+Image',
            ]);
        }
    }
}
