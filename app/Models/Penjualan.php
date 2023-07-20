<?php

namespace App\Models;

use Carbon\Carbon;
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
    ];

    public function getTanggalAttribute($value)
    {
        return Carbon::parse($value)->format('Y-m-d');
    }
}
