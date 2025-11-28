<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RekomAi extends Model
{
    use HasFactory;

    protected $table = 'rekom_ai';

    protected $fillable = [
        'user_id',
        'produk_id',
        'action',
        'bbot_rekom',
    ];

    public function produk()
    {
        return $this->belongsTo(Produk::class, 'produk_id');
    }
}