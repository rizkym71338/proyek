<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    use HasFactory;

    protected $fillable = [
        'tanggal',
        'no_kwitansi',
        'pembeli',
        'produk_keluar',
        'satuan',
        "persediaan_id"
    ];
}
