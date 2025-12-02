<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiItem extends Model
{
    use HasFactory;

    protected $table = 'transaction_items';

    protected $fillable = [
        'transaction_id',
        'product_id',
        'quantity',
        'price',
        'subtotal',
    ];

    public function transaksi()
    {
        return $this->belongsTo(TransaksiKasir::class, 'transaction_id');
    }

    public function produk()
    {
        return $this->belongsTo(Produk::class, 'product_id');
    }
}