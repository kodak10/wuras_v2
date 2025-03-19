<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('images')->insert([
            [
                'path' => 'https://via.placeholder.com/600x400?text=Ordinateur+Image',
                'is_thumbnail' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'path' => 'https://via.placeholder.com/600x400?text=Accessoires+Image',
                'is_thumbnail' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'path' => 'https://via.placeholder.com/600x400?text=Ecrans+Image',
                'is_thumbnail' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'path' => 'https://via.placeholder.com/600x400?text=Imprimantes+Image',
                'is_thumbnail' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'path' => 'https://via.placeholder.com/600x400?text=Stockage+Image',
                'is_thumbnail' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'path' => 'https://via.placeholder.com/600x400?text=Memoire+RAM+Image',
                'is_thumbnail' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
