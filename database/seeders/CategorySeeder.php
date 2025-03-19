<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('categories')->insert([
            [
                'name' => 'Ordinateur',
                'path' => 'ordinateur',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Accessoires',
                'path' => 'accessoires',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Ecrans',
                'path' => 'ecrans',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Imprimantes',
                'path' => 'imprimantes',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Disque de Stockage',
                'path' => 'disque-de-stockage',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Memoire RAM',
                'path' => 'memoire-ram',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
