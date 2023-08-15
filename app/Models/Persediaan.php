<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Persediaan extends Model
{
    use HasFactory;

    protected $fillable = [
        'tanggal',
        'produk_masuk',
        'produk_keluar',
        'stok_produk'
    ];
}
