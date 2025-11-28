<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Produk;

class ProdukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Produk::create([
            'nama' => 'Nasi Goreng',
            'harga' => 15000,
            'stok' => 50,
            'kategori_id' => 1,
            'image' => 'nasi_goreng.jpg'
        ]);

        Produk::create([
            'nama' => 'Ayam Bakar',
            'harga' => 20000,
            'stok' => 30,
            'kategori_id' => 1,
            'image' => 'ayam_bakar.jpg'
        ]);

        Produk::create([
            'nama' => 'Es Teh Manis',
            'harga' => 5000,
            'stok' => 100,
            'kategori_id' => 2,
            'image' => 'es_teh_manis.jpg'
        ]);
    }
}