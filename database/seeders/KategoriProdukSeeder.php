<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\KategoriProduk;

class KategoriProdukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        KategoriProduk::create(['name' => 'Makanan']);
        KategoriProduk::create(['name' => 'Minuman']);
        KategoriProduk::create(['name' => 'Sembako']);
    }
}