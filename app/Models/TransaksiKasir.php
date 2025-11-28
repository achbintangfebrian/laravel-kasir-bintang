<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiKasir extends Model
{
    use HasFactory;

    protected $table = 'transaksi_kasir';

    protected $fillable = [
        'user_id',
        'total',
        'opsi_pay',
    ];

    public function transaksiItems()
    {
        return $this->hasMany(TransaksiItem::class, 'transaksi_id');
    }
}