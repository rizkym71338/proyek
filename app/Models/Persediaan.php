<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Persediaan extends Model
{
    use HasFactory;

    protected $fillable = [
        'tanggal',
        'stok_produk',
        'produk_masuk',
        'produk_keluar',
    ];

    public function getTanggalAttribute($value)
    {
        return Carbon::parse($value)->format('Y-m-d');
    }
}
