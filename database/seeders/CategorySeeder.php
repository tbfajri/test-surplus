<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Makanan Ringan',
            'Makanan Berat',
            'Makanan Vegetarian',
            'Makanan Seafood',
            'Makanan Asia',
            'Makanan Barat',
            'Makanan Indonesia',
            'Makanan Timur Tengah',
            'Makanan Penutup',
            'Minuman',
            'Kue',
            'Roti',
            'Cemilan',
            'Sarapan',
            'Makanan Anak',
            'Makanan Kesehatan',
            'Makanan Diet',
            'Makanan Bebas Gluten',
            'Makanan Rendah Karbohidrat'
        ];

        foreach ($categories as $c){
            DB::table('categorys')->insert([
                'name' => $c,
                'enable' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'created_at' => date('Y-m-d H:i:s'),
            ]);
        }

    }
}
