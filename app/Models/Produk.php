<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = [
        'name',
        'price',
        'stock',
        'category_id',
    ];

    public function kategori()
    {
        return $this->belongsTo(KategoriProduk::class, 'category_id');
    }

    public function transaksiItems()
    {
        return $this->hasMany(TransaksiItem::class, 'product_id');
    }

    public function productSale()
    {
        return $this->hasOne(ProductSale::class, 'product_id');
    }
}