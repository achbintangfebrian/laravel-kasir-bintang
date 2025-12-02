<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get category IDs
        $categories = DB::table('categories')->pluck('id')->toArray();
        
        if (empty($categories)) {
            return;
        }
        
        $products = [];
        $productNames = [
            'Smartphone XYZ', 'Laptop ABC', 'Bluetooth Headphones', 'Smart Watch',
            'T-Shirt', 'Jeans', 'Jacket', 'Sneakers',
            'Novel Book', 'Science Magazine', 'Cookbook', 'Biography',
            'Coffee Maker', 'Blender', 'Toaster', 'Microwave',
            'Football', 'Basketball', 'Tennis Racket', 'Yoga Mat'
        ];
        
        foreach ($productNames as $index => $name) {
            $products[] = [
                'category_id' => $categories[array_rand($categories)],
                'name' => $name,
                'price' => rand(100000, 5000000), // Price in cents
                'stock' => rand(5, 100),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        
        DB::table('products')->insert($products);
    }
}