<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiKasir extends Model
{
    use HasFactory;

    protected $table = 'transactions';

    protected $fillable = [
        'customer_id',
        'total',
    ];

    public function transaksiItems()
    {
        return $this->hasMany(TransaksiItem::class, 'transaction_id');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }
}