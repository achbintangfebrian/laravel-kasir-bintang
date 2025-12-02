<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductSale extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'total_sold',
    ];

    public function product()
    {
        return $this->belongsTo(Produk::class, 'product_id');
    }
}