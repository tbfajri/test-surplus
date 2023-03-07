<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $foodNames = [
            'Nasi Goreng',
            'Mie Goreng',
            'Sate Ayam',
            'Sate Kambing',
            'Ayam Goreng',
            'Ayam Bakar',
            'Ikan Bakar',
            'Ikan Goreng',
            'Udang Goreng',
            'Udang Bakar',
            'Soto Ayam',
            'Soto Betawi',
            'Sop Buntut',
            'Sop Ayam',
            'Gado-gado',
            'Ketoprak',
            'Siomay',
            'Batagor',
            'Bakso',
            'Mie Ayam',
            'Bakmi Jawa',
            'Bakmi Goreng',
            'Bubur Ayam',
            'Nasi Kuning',
            'Nasi Uduk',
            'Nasi Kebuli',
            'Nasi Liwet',
            'Nasi Padang',
            'Rendang',
            'Gulai',
            'Sayur Lodeh',
            'Kari Ayam',
            'Kari Kambing',
            'Sambal Goreng',
            'Tahu Goreng',
            'Tempe Goreng',
            'Perkedel',
            'Kentang Goreng',
            'Buncis Goreng',
            'Capcay',
            'Pecel',
            'Rawon',
            'Sate Padang',
            'Sate Maranggi',
            'Babi Guling',
            'Bakmi Aceh',
            'Laksa',
            'Mie Aceh',
            'Mie Celor',
            'Mie Kocok',
            'Mie Rebus',
            'Pempek',
            'Pindang',
            'Sate Madura',
            'Soto Betawi',
            'Soto Lamongan',
            'Soto Medan',
            'Soto Padang',
            'Soto Sulung',
            'Burger',
            'Hot Dog',
            'Pizza',
            'Spaghetti',
            'Lasagna',
            'Taco',
            'Nachos',
            'Churros',
            'Crepes',
            'Croissant',
            'Donut',
            'Bagel',
            'Sandwich',
            'Panini',
            'Burrito',
            'Tostada',
            'Enchilada',
            'Empanada',
            'Quesadilla',
            'Chimichanga',
            'Tamale',
            'Jambalaya',
            'Gumbo',
            'Red Beans and Rice',
            'Fried Chicken',
            'Biscuits and Gravy',
            'Cornbread',
            'Collard Greens',
            'Mac and Cheese',
            'Sweet Potato Pie',
            'Pecan Pie',
            'Banana Pudding',
            'Fried Catfish',
            'Shrimp and Grits',
            'Crawfish Etouffee',
            'Beignets',
            'Po Boy',
            'Boudin',
        ];


        foreach ($foodNames as $f){
            DB::table('products')->insert([
                'name' => $f,
                'enable' => 1,
                'description' => Str::random(30),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
        }
    }
}
