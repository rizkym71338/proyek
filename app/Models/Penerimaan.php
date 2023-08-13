<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penerimaan extends Model
{
    use HasFactory;

    protected $fillable = [
        'tanggal',
        'penerima',
        'pengirim',
        'produk_masuk',
        'satuan',
        "persediaan_id"
    ];

    public function getTanggalAttribute($value)
    {
        return Carbon::parse($value)->format('Y-m-d');
    }
}
